<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Service\admin\GameRechargeService;
use App\Service\admin\RerollCategoryService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $rerollCategoryService;
    private $gameRechargeService;
    public function __construct(RerollCategoryService $rerollCategoryService, GameRechargeService $gameRechargeService)
    {
        $this->rerollCategoryService = $rerollCategoryService;
        $this->gameRechargeService = $gameRechargeService;  
    }
    public function index()
    {
        $allRerollCategory = $this->rerollCategoryService->getAll();
        $allGameRecharge = $this->gameRechargeService->getAll();
        return view('client.home.home', compact('allRerollCategory','allGameRecharge'));
    }
}
