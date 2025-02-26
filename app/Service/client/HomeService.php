<?php

namespace App\Service\client;

use App\Models\AccountBill;
use App\Models\Game;
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
            return [];
        }
        $rerollSubCategory = RerollSubCategory::where('reroll_category_id', $idRerollCategory)->get();
        return $rerollSubCategory;
    }
    public function getOneRerollSubCategory($idSubRerollCategory)
    {
        if (is_null($idSubRerollCategory) || !is_numeric($idSubRerollCategory)) {
            return [];
        }
        $rerollSubCategory = RerollSubCategory::where('id', $idSubRerollCategory)->get();
        return $rerollSubCategory;
    }
    public function getRerollSubCategoryPackages($idSubRerollCategory)
    {
        if (is_null($idSubRerollCategory) || !is_numeric($idSubRerollCategory)) {
            return [];
        }
        $rerollSubCategoryPackages = RerollSubCategory::find($idSubRerollCategory)->RerollPackage;
        return $rerollSubCategoryPackages;
    }
}
