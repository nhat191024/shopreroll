<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\AccountBill;
use App\Models\GameAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserAccountController extends Controller
{
    // edit this to change token life (in minutes)
    private $MAX_TOKEN_LIFE_MINUTE = 30;

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
        // dd($request->all());
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        // dd($request->email, $user);
        if (!$user) {
            return redirect()->route('client.user.forgot')->with('error', 'Không tìm thấy tài khoản');
        }

        // nếu tìm thấy email:
        // tạo 1 random token và ngày tạo và email đang được chờ reset pass
        // tạo 1 link mà có token vừa tạo rồi gửi qua mail cho ng dùng
        // khi truy cập link đó: check token và time hết hạn (chỉnh thời gian ở đầu file), nếu cả 2 đều valid thì cho render form đổi mật khẩu
        // sau user submit form và đổi pass thành công, xoá bản ghi token đó khỏi table password_reset_tokens

        $token = Str::random(60);
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now()
        ]);

        $resetPasswordLink = route('client.user.reset', ['token' => $token, 'email' => $user->email]);
        $mailContent = '<p>Xin chào ' . $user->name . '</p>
        <p>Bạn đã quên mật khẩu tài khoản của mình. Vui lòng click vào <a href="' . $resetPasswordLink . '">đây</a> để đặt lại mật khẩu.</p>
        <p>Trân trọng,</p>
        <p>Shop Reroll</p>';
        try {
            // TODO: tích hợp gửi email, send $mailContent to $user->email
            // VD: $mailTitle = 'Reset Password';
            // $this->mailService->sendEmail($user->email, $mailTitle, $mailContent);
        } catch (\Throwable $th) {
            return redirect()->route('client.user.forgot')->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
        // return redirect()->route('client.user.forgot')->with('success', 'Gửi yêu cầu thành công. Vui lòng kiểm tra hướng dẫn trong mail');
        dd('Reset Password link: ' . $resetPasswordLink, 'Đang thiếu API gửi email, check UserAccountController.php dòng 83', 'Nhưng có thể copy link reset password ở trên để test luôn');
        return redirect()->route('client.user.forgot')->with([
            'success' => 'Gửi yêu cầu thành công. Vui lòng kiểm tra hướng dẫn trong mail trong vòng ' . $this->MAX_TOKEN_LIFE_MINUTE . ' phút',
            'resetPasswordLink' => $resetPasswordLink
        ]);
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
}
