<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\AccountBill;
use App\Models\BalanceRechargeCardBill;
use App\Models\GameAccount;
use App\Models\User;
use App\Service\client\MailService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Mockery\Generator\StringManipulation\Pass\Pass;

class UserAccountController extends Controller
{
    // edit this to change token life (in minutes)
    private $MAX_TOKEN_LIFE_MINUTE = 30;
    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function changePassword()
    {
        $title = 'Đổi mật khẩu';
        $user = Auth::user();
        return view('client.auth.change', compact('title'));
    }

    public function confirmChangePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('client.user.change')->with('success', 'Đổi mật khẩu thành công');
        } else {
            return redirect()->route('client.user.change')->with('error', 'Mật khẩu không chính xác');
        }
    }

    public function confirmForgotPassword(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('client.user.forgot')->with('error', 'Không tìm thấy tài khoản');
        }

        // nếu tìm thấy email:
        // tạo 1 random token và ngày tạo và email đang được chờ reset pass
        // tạo 1 link mà có token vừa tạo rồi gửi qua mail cho ng dùng
        // khi truy cập link đó: check token và time hết hạn (chỉnh thời gian ở đầu file), nếu cả 2 đều valid thì cho render form đổi mật khẩu
        // sau user submit form và đổi pass thành công, xoá bản ghi token đó khỏi table password_reset_tokens

        $token = Str::random(60);
        try {
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now()
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            if ($e->errorInfo[1] === 1062) {
                // query for duplicate entry
                $record = DB::table('password_reset_tokens')->where('email', $user->email)->first();

                $timeDiff = now()->diffInMinutes($record->created_at);
                if ($timeDiff > $this->MAX_TOKEN_LIFE_MINUTE) {
                    DB::beginTransaction();
                    // delete old token
                    DB::table('password_reset_tokens')->where('email', $user->email)->delete();
                    // insert new token
                    DB::table('password_reset_tokens')->insert([
                        'email' => $user->email,
                        'token' => $token,
                        'created_at' => now()
                    ]);
                    DB::commit();
                } else {
                    return redirect()->route('client.user.forgot')->with('error', 'Yêu cầu đã được gửi trước đó, vui lòng kiểm tra email');
                }
            }
            return redirect()->route('client.user.forgot')->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
        $resetPasswordLink = route('client.user.reset', ['token' => $token, 'email' => $user->email]);

        try {
            $isSuccess = $this->mailService->sendForgotEmail($user, $resetPasswordLink);
            if (!$isSuccess) {
                DB::rollback();
                return redirect()->route('client.user.forgot')->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
            }
            DB::commit();
            return redirect()->route('client.user.forgot')->with('success', 'Gửi yêu cầu thành công. Vui lòng kiểm tra hướng dẫn trong mail trong vòng ' . $this->MAX_TOKEN_LIFE_MINUTE . ' phút');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('client.user.forgot')->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau: ' . $th->getMessage());
        }
    }

    public function forgotPassword()
    {
        $title = 'Lấy lại mật khẩu';
        return view('client.auth.forgot', compact('title'));
    }

    public function confirmResetPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'reset_token' => 'required',
            'reset_email' => 'required|email',
            'new_password' => 'required',
            'new_password_confirmation' => 'required|same:new_password'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $reset_token = $request->reset_token;
        $reset_email = $request->reset_email;

        if ($this->isResetRequestValid($reset_token, $reset_email)) {
            $title = 'Đổi mật khẩu';
            DB::table('password_reset_tokens')->where('token', $reset_token)->delete();
            // now update password
            $user = User::where('email', $reset_email)->first();
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->route('login')->with('success', 'Đổi mật mật khẩu thành công, vui lòng đăng nhập');
        } else {
            DB::table('password_reset_tokens')->where('token', $reset_token)->delete();
            $title = 'Lấy lại mật khẩu';
            return redirect()->route('client.user.forgot')->with('error', 'Yêu cầu bị quá hạn 30 phút, vui lòng thử lại một lần nữa', compact('title'));
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $reset_token = $request->token;
        $reset_email = $request->email;

        if ($this->isResetRequestValid($reset_token, $reset_email)) {
            $title = 'Đổi mật khẩu';
            return view('client.auth.change', compact('title', 'reset_token', 'reset_email'));
        } else {
            DB::table('password_reset_tokens')->where('token', $reset_token)->delete();
            return redirect()->route('client.user.forgot')->with('error', 'Yêu cầu không hợp lệ hoặc đã hết hạn, vui lòng thử lại');
        }
    }

    private function isResetRequestValid($token, $email)
    {
        $passwordResetToken = DB::table('password_reset_tokens')->where('token', $token)->where('email', $email)->first();
        if (!$passwordResetToken) {
            return false;
        }
        $timeDiff = now()->diffInMinutes($passwordResetToken->created_at);
        if ($timeDiff > $this->MAX_TOKEN_LIFE_MINUTE) {
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            return false;
        }
        return true;
    }

    public function topupByBank()
    {
        $title = 'Nạp tiền qua bank, ví điện tử';
        return view('client.topup.bank', compact('title'));
    }

    public function topupByCard()
    {
        $title = 'Nạp tiền qua thẻ cào';
        $balanceRechargeCardBills = BalanceRechargeCardBill::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('client.topup.card', compact('title', 'balanceRechargeCardBills'));
    }

    public function submitTopupByCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_network' => 'required|max:25',
            'card_value' => 'required|integer|in:10000,20000,50000,100000,200000,500000,1000000',
            'card_seri' => 'required|string|min:11|max:25',
            'card_pin' => 'required|string|min:11|max:25',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $bill = new BalanceRechargeCardBill();
        $bill->user_id = Auth::user()->id;
        $bill->number = $request->card_pin;
        $bill->serial = $request->card_seri;
        $bill->mobile_carrier = $request->card_network;
        $bill->amount_fake = $request->card_value * 1;
        // $bill->amount_real = $request->card_value * 0.8;
        // $bill->balance_added = ($request->card_value * 0.8);
        // $bill->balance_before = Auth::user()->balance;
        // $bill->balance_after = Auth::user()->balance + ($request->card_value * 0.8);
        $bill->status = 0; // 0: pending, 1: success, 2: failed
        $bill->save();

        // $response = $this->sendTopupCardRequest($bill);
        $response = $this->sendTopupCardRequest($bill);

        if ($response->successful() && $response->json()['status'] == 99) {
            $responseJson = $response->json();
            $bill->status = $responseJson['status'];
            $bill->note = $responseJson['message'];
            $bill->save();
            return redirect()->route('client.user.topup.card')->with('success', 'Đặt nạp tiền thẻ cào thành công, số tiền sẽ được cộng vào tài khoản sau khi hệ thống xử lý thành công');
        } else {
            $responseJson = $response->json();
            $bill->status = $responseJson['status'];
            $bill->note = $responseJson['message'];
            $bill->save();
            return redirect()->route('client.user.topup.card')->with('error', $responseJson['message']);
        }
    }

    public function sendTopupCardRequest(BalanceRechargeCardBill $bill)
    {
        // * EXAMPLE
        // * https://apithe.com/chargingws/v2
        // payload
        // {
        //     "serial": "10009256840805",
        //     "request_id": "353454r34tfd",
        //     "telco": "VIETTEL",
        //     "code": "018991216881305",
        //     "amount": "10000",
        //     "partner_id": "100081",
        //     "sign": "428984b1652dce8b1d619185b8e20171",
        //     "command": "charging"
        // }
        // make api call
        // * sign: Là kết quả sau khi mã hóa MD5 của chuỗi partner_key, code và serial nối liền.
        // * md5 ( partner_key + code + serial )
        // $response = Http::post('https://apithe.com/chargingws/v2', [
        $response = Http::post('http://localhost:3000/chargingws/v2', [
            'serial' => $bill->serial,
            'request_id' => $bill->id,
            'telco' => $bill->mobile_carrier,
            'code' => $bill->number,
            'amount' => $bill->amount_real,
            'partner_id' => env('PARTNER_ID'),
            'sign' => md5(env('PARTNER_KEY') . $bill->number . $bill->serial),
            'command' => 'charging',
        ]);

        // * EXAMPLE RESPONSE
        // {
        //     "status": "99",
        //     "message": "Thẻ đã gửi thành công và đang chờ xử lý",
        //     "trans_id": "qYTvAKdarB",
        //     "code": "018991216881305",
        //     "serial": "10009256840805",
        //     "telco": "VIETTEL",
        //     "declared_value": 10000,
        //     "value": null,
        //     "receive_amount": null,
        //     "request_id": "353454r34tfd",
        //     "sign": "096fa078a2c35d078a9b116420de9bec"
        // }

        return $response;
    }
}
