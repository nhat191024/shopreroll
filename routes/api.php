<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TopUpCallback;

//* Test URL: http://localhost:8000/api/topup/card/callback
//* Test Data (raw body) for postman:
// {"status":"1","message":"Th\u00e0nh c\u00f4ng","request_id":"11","declared_value":"50000","value":"50000","amount":"25000","code":"444444444444","serial":"444444444444","telco":"VIETTEL","trans_id":"54180","callback_sign":"c45b9f606e27cb9f12a41bd9a3033dbc"}
//! Note: Required .env variable: PARTNER_KEY=***
//? "request_id" is used to find BillID and not UserID.
//? The test may fail, check "callback_sign" with md5($partner_key . $code . $serial)
Route::post('/topup/card/callback', [TopUpCallback::class, 'callbackCardTopUp']);

//* Test URL: http://localhost:8000/api/topup/bank/callback
//* Test Data (raw body) for postman:
// { "so_tien": 12345, "ten_bank": "Vietcombank", "ten_khach": "Nguyen Van A", "sdt_khach": "0912345678", "ma_gd": "1234567890", "noi_dung": "nap 1", "soDu_bank": 5000000, "thoi_gian": "2025-04-06T10:30:00", "trans_id": "121212", "ma_baoMat": "null123" }
//! Note: ma_baoMat needs to be the same as BOTSMS_CALLBACK_SECRET=*** in .env
//? "noi_dung" will be used to check for UserID. Example: "nap 1" means USER with ID = 1.
Route::post('/topup/bank/callback', [TopUpCallback::class, 'callbackBankTopUp']);
