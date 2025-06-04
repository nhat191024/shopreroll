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
        $title = 'Tất cả acc game đã mua';
        $accountBills = $this->accountBillService->getAllBillByUserId(Auth::id());
        return view('client.layouts.myAcc', compact('accountBills', 'title'));
    }

    public function balanceHistory()
    {
        $title = 'Lịch sử giao dịch';
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();

        $accountBills = $user->BillAccount; //
        $rerollBills = $user->RerollBill; //
        $rechargeBills = $user->BillRecharge; //
        $balanceRechargeBankBills = $user->BalanceRechargeBankBill; //
        $balanceRechargeCardBills = $user->BalanceRechargeCardBill; //

        $collaboratorCommissionBills = $user->CollaboratorCommissionBill; //
        // dd($collaboratorCommissionBills);
        $allBills = [];

        // -{{ number_format($data->balance_added ?? 'N/A', 0, ',', '.') }} VND
        foreach ($collaboratorCommissionBills as $bill) {
            $allBills[] = [
                'id' => $bill->id,
                'balance_change' => '+' . number_format($bill->price ?? 'N/A', 0, ',', '.'),
                'is_decrease' => false,
                'balance_before' => number_format($bill->balance_before ?? 'N/A', 0, ',', '.'),
                'balance_after' => number_format($bill->balance_after ?? 'N/A', 0, ',', '.'),
                'content' => "<b>Loại: </b>".($bill->GameAccount->GameCategory->name ?? 'N/A')
                    ."<br><b>Tên game: </b>".($bill->GameAccount->Game->name ?? 'N/A')
                    ."<br><b>Tài khoản game:</b> ".($bill->GameAccount->title ?? 'N/A')
                    ."<br> <b>Ghi chú:</b> ".($bill->GameAccount->title?? 'N/A')
                    ."<br> <b>Phí hoa hồng: ".($bill->commission_fee?? '0').'%',
                'type' => "Người dùng mua acc của bạn",
                'created_at' => $bill->created_at->format('d/m/Y H:i:s'),
            ];
        }

        foreach ($accountBills as $bill) {
            $allBills[] = [
                'id' => $bill->id,
                'balance_change' => '-' . number_format($bill->price ?? 'N/A', 0, ',', '.'),
                'is_decrease' => true,
                'balance_before' => number_format($bill->balance_before ?? 'N/A', 0, ',', '.'),
                'balance_after' => number_format($bill->balance_after ?? 'N/A', 0, ',', '.'),
                'content' => "<b>Loại: </b>".($bill->GameAccount->GameCategory->name ?? 'N/A')
                    ."<br><b>Tên game: </b>".($bill->GameAccount->Game->name ?? 'N/A')
                    ."<br><b>Tài khoản game:</b> ".($bill->GameAccount->title ?? 'N/A')
                    ."<br> <b>Ghi chú:</b> ".($bill->GameAccount->title?? 'N/A'),
                'type' => "Mua tài khoản game",
                'created_at' => $bill->created_at->format('d/m/Y H:i:s'),
            ];
        }

        foreach ($rerollBills as $bill) {
            $allBills[] = [
                'id' => $bill->id,
                'balance_change' => '-' . number_format($bill->price ?? 'N/A', 0, ',', '.'),
                'is_decrease' => true,
                'balance_before' => number_format($bill->balance_before ?? 'N/A', 0, ',', '.'),
                'balance_after' => number_format($bill->balance_after ?? 'N/A', 0, ',', '.'),
                'content' => "<b>Tên gói: </b>".($bill->RerollPackage->name ?? 'N/A')
                    ."<br><b>Loại reroll: </b>".($bill->RerollPackage->RerollSubCategory->name ?? 'N/A')
                    ."<br><b>Loại gói: </b>".($bill->RerollPackage->RerollSubCategory->RerollCategory->name ?? 'N/A'),
                'type' => "Mua gói reroll",
                'created_at' => $bill->created_at->format('d/m/Y H:i:s'),
            ];
        }

        foreach ($rechargeBills as $bill) {
            $allBills[] = [
                'id' => $bill->id,
                'balance_change' => '-' . number_format($bill->RechargePackage->price ?? 'N/A', 0, ',', '.'),
                'is_decrease' => true,
                'balance_before' => number_format($bill->balance_before ?? 'N/A', 0, ',', '.'),
                'balance_after' => number_format($bill->balance_after ?? 'N/A', 0, ',', '.'),
                'content' => "<b>Gói nạp: </b>".($bill->RechargePackage->name ?? 'N/A')
                    ."<br><b>Tên game: </b>".($bill->RechargePackage->GameRecharge->name ?? 'N/A')
                    ."<br><b>Tên người nạp: </b>".($bill->customer_name ?? 'N/A')
                    ."<br><b>Tên người nạp: </b>".($bill->customer_name ?? 'N/A')
                    ."<br><b>Trạng thái: </b>".($bill->status == 1 ? 'Thành công'
                        : ($bill->status == 2 ? 'Thất bại' : 'Đang chờ xử lý')
                    ),
                'type' => "Mua tài khoản game",
                'type' => "Gói nạp tiền game",
                'created_at' => $bill->created_at->format('d/m/Y H:i:s'),
            ];
        }

        foreach ($balanceRechargeBankBills as $bill) {
            $allBills[] = [
                'id' => $bill->id,
                'balance_change' => '+' . number_format($bill->balance_added ?? 'N/A', 0, ',', '.'),
                'is_decrease' => $bill->balance_added >= 0 ? false : true,
                'balance_before' => number_format($bill->balance_before ?? 'N/A', 0, ',', '.'),
                'balance_after' => number_format($bill->balance_after ?? 'N/A', 0, ',', '.'),
                'content' => "<b>ND Chuyển khoản: </b>".($bill->note ?? 'N/A')
                    ."<br><b>Tên bank: </b>".($bill->bank ?? 'N/A')
                    ."<br><b>Mã giao dịch: </b>".($bill->bank_trans_id ?? 'N/A')
                    ."<br><b>SĐT người nạp: </b>".($bill->customer_phone ?? 'N/A')
                    ."<br><b>Tên người nạp: </b>".($bill->customer_name ?? 'N/A')
                    ."<br><b>Trạng thái: </b>".($bill->status == 1 ? 'Thành công'
                        : ($bill->status == 2 ? 'Thất bại' : 'Đang chờ xử lý')
                    ),
                'type' => "Nạp số dư qua banking",
                'created_at' => $bill->created_at->format('d/m/Y H:i:s'),
            ];
        }

        foreach ($balanceRechargeCardBills as $bill) {
            $allBills[] = [
                'id' => $bill->id,
                'balance_change' => '+' . number_format($bill->balance_added ?? 'N/A', 0, ',', '.'),
                'is_decrease' => $bill->balance_added >= 0 ? false : true,
                'balance_after' => number_format($bill->balance_after ?? 'N/A', 0, ',', '.'),
                'balance_before' => number_format($bill->balance_before ?? 'N/A', 0, ',', '.'),
                'content' => "<b>Số thẻ: </b>".($bill->number ?? 'N/A')
                    ."<br><b>Sêri thẻ: </b>".($bill->serial ?? 'N/A')
                    ."<br><b>Nhà mạng: </b>".($bill->mobile_carrier ?? 'N/A')
                    ."<br><b>Mệnh giá thẻ: </b>".(number_format($bill->amount_real) ?? number_format($bill->amount_fake) ?? 'N/A') ." VND"
                    ."<br><b>Mã giao dịch: </b>".($bill->trans_id ?? 'N/A')
                    ."<br><b>Trạng thái: </b>".($bill->status == 1 ? 'Thành công'
                        : ($bill->status == 2 ? 'Số tiền không hợp lệ'
                            : ($bill->status == 99 ? 'Đang chờ xử lý'
                                : ($bill->status == 0 ? 'Đang chờ xử lý'
                                    : 'Thất bại'
                                )
                            )
                        )
                    )
                    ."<br><b>Note: </b>".($bill->note?? 'N/A'),
                'type' => "Nạp số dư qua thẻ cào",
                'created_at' => $bill->created_at->format('d/m/Y H:i:s'),
            ];
        }

        usort($allBills, function($a, $b) {
            return strtotime($a['created_at']) <=> strtotime($b['created_at']);
        });
        return view('client.user.balance-history', compact('allBills', 'title'));
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
            $user = Auth::user();
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
                'price' => $gameAccount->price_out,
                'balance_before' => $user->balance,
                'balance_after' => $user->balance - $gameAccount->price_out
            ]);
            $gameAccount->status = 2;
            $gameAccount->save();
            $user->save();
            new CollaboratorController()->collaboratorCommissionConfirm($gameAccount);
            DB::commit();
            return redirect()->route('client.account.all')->with('success', 'Thanh toán thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            // dd($th, $gameAccountId, $th->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi!'. $th->getMessage());
        }
    }

}
