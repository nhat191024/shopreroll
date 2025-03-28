<?php

namespace App\Http\Controllers\client;

use App\Models\RerollCategory;
use App\Models\GameRecharge;

use App\Http\Controllers\Controller;
use App\Service\admin\GameRechargeService;
use App\Service\admin\RerollCategoryService;
use App\Service\client\HomeService;
use Illuminate\Http\Request;

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

        return view('client.home.home', compact('rerollCategories', 'gameRecharges'));
    }

    public function rerollDetail($id)
    {
        $rerollSubCategory = $this->homeService->getRerollSubCategory($id);
        return view('client.home.reroll-detail', compact('rerollSubCategory'));
    }

    public function rerollTutorial($idSubRerollCategory)
    {
        $rerollSubCategory = $this->homeService->getOneRerollSubCategory($idSubRerollCategory);
        $rerollSubCategoryPackages = $this->homeService->getRerollSubCategoryPackages($idSubRerollCategory);
        return view('client.home.reroll-tutorial', compact('rerollSubCategory', 'rerollSubCategoryPackages'));
    }

    public function buyRerollDetail(Request $request)
    {
        dd('Đã nhận đc yêu cầu mua gói reroll: ',$request->all());
    }
}
