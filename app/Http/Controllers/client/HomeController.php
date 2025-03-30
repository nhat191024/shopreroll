<?php

namespace App\Http\Controllers\client;

use App\Models\RerollCategory;
use App\Models\GameRecharge;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameCategory;
use App\Models\GameItemType;
use App\Models\RerollKey;
use App\Models\RerollSubCategory;
use App\Service\admin\GameRechargeService;
use App\Service\admin\RerollCategoryService;
use App\Service\client\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $homeService;
    public function __construct()
    {
        $this->homeService = app(HomeService::class);
    }
    public function index()
    {
        $rerollCategories = RerollCategory::where('status', 1)->get();
        $gameRecharges = GameRecharge::where('status', 1)->get();
        $gameAccountCategories = $this->homeService->getGameAccountCategories();
        return view('client.home.home', compact('rerollCategories', 'gameRecharges', 'gameAccountCategories'));
    }

    public function rerollDetail($id)
    {
        $rerollSubCategory = $this->homeService->getRerollSubCategory($id);
        return view('client.home.reroll-detail', compact('rerollSubCategory'));
    }

    public function gameAccountList($gameAccountId, $categoryId)
    {
        $gameAccounts = $this->homeService->getGameAccountList($gameAccountId, $categoryId);
        $title = Game::find($gameAccountId)->name;
        return view('client.account-shop.list', compact('gameAccounts', 'title'));
    }
    
    public function accountDetail($accountId)
    {
        $gameAccount = $this->homeService->getGameAccountDetail($accountId);
        $accountAttributes = $gameAccount->AccountAttribute;
        $accountItems = $gameAccount->AccountItem
            ->groupBy(function($item) {
                return $item->GameItem->gameItemType->id;
            })
            ->map(function($items, $typeId) {
                return [
                    'type' => GameItemType::find($typeId),
                    'items' => $items->map(function($item) {
                        return $item->GameItem;
                    })
                ];
            });
        return view('client.account-shop.detail', compact('gameAccount', 'accountAttributes','accountItems'));
    }

    public function rerollTutorial($idSubRerollCategory)
    {
        $rerollSubCategory = $this->homeService->getOneRerollSubCategory($idSubRerollCategory);
        $rerollSubCategoryPackages = $this->homeService->getRerollSubCategoryPackages($idSubRerollCategory);
        return view('client.home.reroll-tutorial', compact('rerollSubCategory', 'rerollSubCategoryPackages'));
    }

    public function buyRerollDetail(Request $request)
    {
        $payTotal = RerollSubCategory::find($request->reroll_sub_category_id)->RerollPackage->where('id', $request->packet_id)->first()->price;
        $availableKeys = RerollKey::where('reroll_package_id', $request->packet_id)
            ->where('status', 1)
            ->get();
        $chosenRandomKey = $availableKeys->random();

        try {
            DB::beginTransaction();
            $this->homeService->createRerollBill($request->packet_id, $chosenRandomKey->id, $payTotal);
            // if no reroll key available
            if ($availableKeys->count() == 0) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Không còn gói reroll nào khả dụng!');
            }
            // update status của key đã chọn
            $rerollKey = RerollKey::find($chosenRandomKey->id);
            $rerollKey->status = 0;
            $rerollKey->save();
            // trừ tiền trong tài khoản của user
            $user = auth()->user();
            $user->balance -= $payTotal;
            if ($user->balance < 0) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Số dư tài khoản không đủ để thanh toán!');
            }
            $user->save();
            DB::commit();
            return redirect()->route('client.MyKey.index')->with('success', 'Thanh toán thành công!');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd('Đã xảy ra lỗi trong quá trình thanh toán: ', $th->getMessage());
        }
    }
}
