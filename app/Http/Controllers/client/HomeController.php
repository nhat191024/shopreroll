<?php

namespace App\Http\Controllers\client;

use App\Models\RerollCategory;
use App\Models\GameRecharge;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameAccount;
use App\Models\GameAttribute;
use App\Models\GameCategory;
use App\Models\GameItem;
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
        // [['name' => 'Keith sierra', 'amount' => '22,707,000'], ['name' => 'Nam', 'amount' => '13,282,600'], ['name' => 'Perawit', 'amount' => '11,111,275'], ['name' => 'cau vang', 'amount' => '6,250,000'], ['name' => 'Nguyễn Duy', 'amount' => '4,373,010'], ['name' => 'Vo phuc khang', 'amount' => '4,310,000'], ['name' => 'Dương Quang Ánh', 'amount' => '4,270,000'], ['name' => 'bac', 'amount' => '4,218,520'], ['name' => 'Nguyễn minh Quang', 'amount' => '3,940,002'], ['name' => 'Nguyễn Văn Trường', 'amount' => '3,573,000']]
        $topUpRanking = $this->homeService->getTopUpRanking();
        return view('client.home.home', compact('rerollCategories', 'gameRecharges', 'gameAccountCategories', 'topUpRanking'));
    }

    public function rerollDetail($id)
    {
        $rerollSubCategory = $this->homeService->getRerollSubCategory($id);
        return view('client.home.reroll-detail', compact('rerollSubCategory'));
    }

    public function gameAccountList($gameId, $categoryId, Request $request)
    {
        $gameAccounts = collect();
        if ($request->has('search')) {
            $searchAttributes = $request->get('attributes');
            $searchGameItems = $request->get('game_items');
            $searchMinPrice = 0;
            $searchMaxPrice = 0;
            try {
                $prices = explode('|', $request->get('price'));
                $searchMinPrice = (int) $prices[0];
                $searchMaxPrice = (int) $prices[1];
            } catch (\Exception $e) {
                $searchMinPrice = 0;
                $searchMaxPrice = 0;
            }
            $searchSortPrice = $request->get('sort_price');
            $gameAccountId = $request->input('acc_id');

            $query = GameAccount::where('game_id', $gameId)
                ->where('status', 1)
                ->where('game_category_id', $categoryId);

            if ($searchMinPrice > 0 && $searchMaxPrice > 0) {
                $query->whereBetween('price_out', [$searchMinPrice, $searchMaxPrice]);
            }

            if (!empty($searchAttributes)) {
                $query->whereHas('AccountAttribute', function($q) use ($searchAttributes) {
                    $q->whereIn('id', $searchAttributes);
                });
            }

            if (!empty($searchGameItems)) {
                $query->whereHas('AccountItem', function($q) use ($searchGameItems) {
                    $q->whereIn('game_item_id', $searchGameItems);
                });
            }

            if ($searchSortPrice) {
                $query->orderBy('price_out', strtolower($searchSortPrice));
            }

            $gameAccounts = $query->get();

            // query is for finding id only
            if ($gameAccountId != null) {
                try {
                    $gameAccounts = $gameAccounts->push(GameAccount::where('id', $gameAccountId)->firstOrFail());
                } catch (\Throwable $th) {
                    $gameAccounts = collect();
                }
            }
        } else {
            $gameAccounts = $this->homeService->getGameAccountList($gameId, $categoryId);
        }
        $title = Game::find($gameId)->name . ' - ' . GameCategory::find($categoryId)->name;
        $gameAttributes = Game::find($gameId)->GameAttribute;
        $gameItemTypes = Game::find($gameId)->GameItemType;
        $search = $request->get('search');
        $request->flash();
        return view('client.account-shop.list', compact('gameAccounts', 'title', 'gameId', 'categoryId', 'gameItemTypes', 'gameAttributes', 'search', 'request'));
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
        if ($availableKeys->count() == 0) {
            return redirect()->back()->with('error', 'Không còn gói reroll nào khả dụng!');
        }
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
            if ($rerollKey->status != 1) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Không còn gói reroll nào khả dụng!');
            }
            $rerollKey->status = 2;
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
