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
            'status' => 1,
        ]);
    }

    public function getGameAccountCategories()
    {
        return Game::where('status', 1)
            ->with(['GameCategory' => function($query) {
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
                return $gameAccount->GameAccount()->paginate($itemsPerpage);
            } else {
                $category = $gameAccount->GameCategory->where('id', $categoryId)->first();
                return $category ? $category->GameAccount()->paginate($itemsPerpage) : collect([]);
            }
        } catch (\Exception $e) {
            return collect([]);
        }
    }
}
