<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Service\admin\GameRechargeService;
use App\Service\admin\RerollCategoryService;
use App\Service\client\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $rerollCategoryService;
    private $gameRechargeService;
    private $homeService;
    public function __construct()
    {
        $this->rerollCategoryService = app(RerollCategoryService::class);
        $this->gameRechargeService = app(GameRechargeService::class);
        $this->homeService = app(HomeService::class);
    }
    public function index()
    {
        $allRerollCategory = $this->rerollCategoryService->getAll();
        $allGameRecharge = $this->gameRechargeService->getAll();
        return view('client.home.home', compact('allRerollCategory','allGameRecharge'));
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
