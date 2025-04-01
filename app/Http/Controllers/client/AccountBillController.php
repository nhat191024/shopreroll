<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\AccountBill;
use App\Models\GameAccount;
use App\Service\client\AccountBillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountBillController extends Controller
{
    private $accountBillService;
    public function __construct(AccountBillService $accountBillService)
    {
        $this->accountBillService = $accountBillService;
    }
    public function genshin()
    {
        $accountBills = $this->accountBillService->getAllGenshinBillByUserId(Auth::id());
        return view('client.layouts.myAcc', compact('accountBills'));
    }
    public function allAccount()
    {
        $accountBills = $this->accountBillService->getAllBillByUserId(Auth::id());
        return view('client.layouts.myAcc', compact('accountBills'));
    }
    public function buyGameAccount($gameAccountId)
    {
        try {
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            DB::beginTransaction();
            $gameAccount = GameAccount::find($gameAccountId);
            if (is_null($gameAccount)) {
                // dd('Acc game không tồn tại!');
                return redirect()->back()->with('error', 'Acc game không tồn tại!');
            }
            if ($gameAccount->status != 1) {
                // dd('Acc nây không có sẵn!');
                return redirect()->back()->with('error', 'Acc nây không có sẵn!');
            }
            $user = auth()->user();
            $user->balance -= $gameAccount->price_out;
            if ($user->balance < 0) {
                DB::rollBack();
                // dd('Số dư tài khoản không đủ để thanh toán!');
                return redirect()->back()->with('error', 'Số dư tài khoản không đủ để thanh toán!');
            }
            // dd($gameAccountId, $gameAccount->price_out);
            AccountBill::create([
                'user_id' => Auth::id(),
                'account_id' => $gameAccountId,
                'price' => $gameAccount->price_out
            ]);
            $gameAccount->status = 2;
            $gameAccount->save();
            $user->save();
            DB::commit();
            return redirect()->route('client.account.all')->with('success', 'Thanh toán thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            // dd($th, $gameAccountId, $th->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!');
        }
    }
}
