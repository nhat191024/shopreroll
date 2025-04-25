<?php

namespace App\Service\client;

use App\Models\AccountBill;
use App\Models\Game;
use App\Models\GameAccount;
use App\Models\RerollBill;
use App\Models\RerollSubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeService
{
    public function getRerollSubCategory($idRerollCategory)
    {
        if (is_null($idRerollCategory) || !is_numeric($idRerollCategory)) {
            return collect([]);
        }
        $rerollSubCategory = RerollSubCategory::where('reroll_category_id', $idRerollCategory)->get();
        return $rerollSubCategory;
    }
    public function getOneRerollSubCategory($idSubRerollCategory)
    {
        if (is_null($idSubRerollCategory) || !is_numeric($idSubRerollCategory)) {
            return collect([]);
        }
        $rerollSubCategory = RerollSubCategory::where('id', $idSubRerollCategory)->get();
        return $rerollSubCategory;
    }
    public function getRerollSubCategoryPackages($idSubRerollCategory)
    {
        if (is_null($idSubRerollCategory) || !is_numeric($idSubRerollCategory)) {
            return collect([]);
        }
        $rerollSubCategoryPackages = RerollSubCategory::find($idSubRerollCategory)->RerollPackage;
        return $rerollSubCategoryPackages;
    }

    public function createRerollBill($rerollPackageId, $rerollKeyId, $price)
    {
        RerollBill::create([
            'user_id' => Auth::user()->id,
            'reroll_package_id' => $rerollPackageId,
            'reroll_key_id' => $rerollKeyId,
            'price' => $price,
            'balance_before' => Auth::user()->balance,
            'balance_after' => Auth::user()->balance - $price,
            'status' => 1,
        ]);
    }

    public function getGameAccountCategories()
    {
        return Game::where('status', 1)
            ->with(['GameCategory' => function ($query) {
                $query->where('status', 1);
            }])
            ->get();
    }

    public function getGameAccountDetail($accountId)
    {
        return GameAccount::find($accountId);
    }

    public function getGameAccountList($gameAccountId, $categoryId, $itemsPerpage = 12)
    {
        try {
            if (is_null($gameAccountId) || !is_numeric($gameAccountId)) {
                return collect([]);
            }
            $gameAccount = Game::find($gameAccountId);
            if (!$gameAccount) {
                return collect([]);
            }
            if ($categoryId == 0) {
                return $gameAccount->GameAccount()->where('status', 1)->paginate($itemsPerpage);
            } else {
                $category = $gameAccount->GameCategory->where('id', $categoryId)->first();
                return $category ? $category->GameAccount()->where('status', 1)->paginate($itemsPerpage) : collect([]);
            }
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function getTopUpRanking()
    {
        return \App\Models\RechargeBill::join('users', 'recharge_bills.user_id', '=', 'users.id')
            ->selectRaw('users.name, SUM(recharge_packages.price) as amount')
            ->join('recharge_packages', 'recharge_bills.recharge_package_id', '=', 'recharge_packages.id')
            ->where('recharge_bills.status', 'completed')
            ->groupBy('users.id', 'users.name')
            ->orderBy('amount', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    'amount' => number_format($item->amount, 0, '.', ',').'đ',
                ];
            })
            ->toArray();
    }
}
