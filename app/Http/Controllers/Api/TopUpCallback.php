<?php

namespace App\Http\Controllers\Api;

use App\Models\BalanceRechargeCardBill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BalanceRechargeBankBill;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TopUpCallback extends Controller
{
    public function callbackCardTopUp(Request $request)
    {
        // * all request data from apithe document (EXAMPLE)
        // {
        //     "status":1,
        //     "message":"Th\u00e0nh c\u00f4ng",
        //     "request_id":"989876", // Bill ID (tự đặt)
        //     "declared_value":50000, // Mệnh giá thẻ do người dùng nhập vào
        //     "value":50000, // Mệnh giá thực tế của thẻ do API trả về
        //     "amount":25000, // Số tiền được cộng vào tài khoản sau khi nạp thành công
        //     "code":"314688440422676",
        //     "serial":"10003395125761",
        //     "telco":"VIETTEL",
        //     "trans_id":54180, // callback ID (tự sinh)
        //     "callback_sign":"17b118fe86852c52ea126c9537617f6d" // md5($partner_key . $code . $serial)
        //     }

        DB::beginTransaction();
        try {
            if (empty($request->all())) {
                return response()->json(['status' => 'error', 'message' => 'Invalid request'], 400);
            }
            $status = $request->input('status');
            $message = $this->decodeUnicodeString($request->input('message'));
            $requestId = $request->input('request_id');
            $declaredValue = $request->input('declared_value');
            $value = $request->input('value');
            $amount = $request->input('amount');
            $code = $request->input('code');
            $serial = $request->input('serial');
            $telco = $request->input('telco');
            $transId = $request->input('trans_id');
            $callbackSign = $request->input('callback_sign');

            $checkSign = $this->checkMD5Hash(
                env('PARTNER_KEY'),
                $code,
                $serial,
                $callbackSign
            );

            if (empty($status) || empty($message) || empty($requestId) || empty($value) || empty($amount) || empty($code) || empty($serial) || empty($transId)) {
                return response()->json(['status' => 'error', 'message' => 'Invalid request data'], 400);
            }

            if (!$checkSign) {
                return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
            }

            $bill = BalanceRechargeCardBill::find($requestId);
            if (!$bill) {
                return response()->json(['status' => 'error', 'message' => 'Bill not found'], 404);
            }

            // avoid duplicate callback
            if ($bill->status != 0) {
                return response()->json(['status' => 'error', 'message' => 'Bill already processed'], 400);
            }

            // Update bill details with response data
            $bill->note = $message;
            $bill->trans_id = $transId;
            $bill->amount_fake = $declaredValue ?? 0;
            $bill->amount_real = $value ?? 0;
            $bill->mobile_carrier = $telco ?? 'N/A';
            $bill->balance_added = $amount ?? 0;

            // Handle different status codes
            $user = User::where('id', $bill->user_id)->lockForUpdate()->first();
            switch ($status) {
                case 1:
                    // Success
                    $bill->status = 1;
                    if ($user) {
                        $bill->balance_before = $user->balance;
                        $bill->balance_after = $user->balance + $amount;
                        $user->balance += $amount;
                        $bill->balance_added = $amount;
                    }
                    break;
                case 2:
                    // User entered wrong card value (but success)
                    //! DO NOT update user balance
                    $bill->status = 2;
                    $bill->balance_added = 0;
                    break;
                case 3:
                    // Card error, top-up fail
                    $bill->balance_added = 0;
                    $bill->status = 3;
                    break;
                default:
                    $bill->balance_added = 0;
                    $bill->status = 3;
            }
            $user->save();
            $bill->save();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Top-up successful']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json(['status' => 'failed', 'message' => $th->getMessage()], 500);
        }
    }

    public function callbackBankTopUp(Request $request)
    {
        // * botsms callback document below (EXAMPLE)
        // Phương thức: Post
        // Thông tin sẽ nhận về:
        // 'so_tien' => Số tiền khách chuyển
        // 'ten_bank' => Tên ngân hàng (bao gồm cả Momo)
        // 'id_khach' => id khách của shop
        // 'ten_khach' => Họ tên thật của khách. (nếu có)
        // 'sdt_khach' => Số điện thoại thực của khách (nếu có),
        // 'ma_gd' => Mã giao dịch lần bank đó.
        // 'noi_dung' => Nội dung khách viết khi bank.
        // 'soDu_bank' => Số dư bank hiện tại sau khi nhận tiền.
        // 'thoi_gian' => Thời gian bank (theo ngân hàng)
        // 'trans_id' => số id phân biệt mõi lần callback.
        // 'ma_baoMat' => Mã bảo mật chỉ chỉ bên shop và botsms biết để xác thực với nhau. Tránh callback giả mạo.

        DB::beginTransaction();
        try {
            if (empty($request->all())) {
                return response()->json(['status' => 'error', 'message' => 'Invalid request'], 400);
            }

            $amount = $request->input('so_tien');
            $bank = $request->input('ten_bank');
            $transId = $request->input('trans_id');
            $note = $request->input('noi_dung');
            $phone = $request->input('sdt_khach');
            $customerName = $request->input('ten_khach');
            $transactionId = $request->input('ma_gd');
            $callbackTransId = $request->input('trans_id');
            $securityCode = $request->input('ma_baoMat');

            $userId = $this->extractUserIdFromNote($note);

            // Validate required fields
            if (empty($amount) || empty($bank) || empty($userId) || empty($transId)) {
                return response()->json(['status' => 'error', 'message' => 'Missing required fields'], 400);
            }

            // Verify security code
            if ($securityCode !== env('BOTSMS_CALLBACK_SECRET')) {
                return response()->json(['status' => 'error', 'message' => 'Invalid security code'], 401);
            }

            // Create bank bill record
            $user = User::where('id', $userId)->lockForUpdate()->first();
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
            }

            // Avoid duplicate callback
            // ! Hiện đang bị tắt vì chưa tìm ra cách nào thực sự hiệu quả để kiểm tra trùng callback
            // ! việc này tuỳ thuộc vào bên botsms (bên đó có tính năng re-send callback)
            // $existingBill = BalanceRechargeBankBill::where('bank_trans_id', $transactionId)->first();
            // if ($existingBill) {
            //     return response()->json(['status' => 'error', 'message' => 'Duplicate callback'], 400);
            // }

            $bill = new BalanceRechargeBankBill();
            $bill->user_id = $userId * 1;
            $bill->bank = $bank;
            $bill->amount = $amount;
            $bill->balance_added = $amount;
            $bill->balance_before = $user->balance;
            $bill->balance_after = $user->balance + $amount;
            $bill->note = $note;
            $bill->customer_phone = $phone;
            $bill->customer_name = $customerName;
            $bill->bank_trans_id = $transactionId;
            $bill->callback_trans_id = $callbackTransId;
            $bill->status = 1; // Success status

            // Update user balance
            $user->balance += $amount;

            $user->save();
            $bill->save();

            // temporsary return the bill as json
            // return response()->json($bill);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Bank top-up processed successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }

    private function checkMD5Hash($partner_key, $code, $serial, $callback_hash)
    {
        $local_hash = md5($partner_key . $code . $serial);
        return $local_hash === $callback_hash;
    }

    private function extractUserIdFromNote($note)
    {
        // nap 311550
        // 311550
        $extractedId = preg_replace('/[^0-9]/', '', $note);
        return $extractedId;
    }

    /**
     * Convert a Unicode-escaped string (like Th\u00e0nh c\u00f4ng) into readable UTF-8 text.
     *
     * @param string $unicodeString
     * @return string
     */
    public function decodeUnicodeString(string $unicodeString): string
    {
        if (!str_starts_with($unicodeString, '"')) {
            $unicodeString = '"' . $unicodeString . '"';
        }

        $decoded = json_decode($unicodeString);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $unicodeString;
        }

        return $decoded;
    }
}
