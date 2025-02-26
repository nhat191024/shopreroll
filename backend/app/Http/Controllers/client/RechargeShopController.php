<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Service\admin\GameRechargeService;
use App\Service\admin\RerollCategoryService;
use App\Service\client\RechargeShopService;
use Illuminate\Http\Request;

class RechargeShopController extends Controller
{
    private $rechargeShopService;
    public function __construct(RechargeShopService $rechargeShopService)
    {
        $this->rechargeShopService = $rechargeShopService;
    }
    public function index($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $gameRecharge = $this->rechargeShopService->getCurrentGameRechargeById($id);
        $rechargePackages = $gameRecharge->rechargePackages;
        $rechargeBills = $this->rechargeShopService->getAllRechargeBillsByUser();
        return view('client.home.game-recharge', compact('rechargePackages','gameRecharge', 'rechargeBills'));
    }

    public function rechargeConfirm(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $this->rechargeShopService->rechargeConfirm($request);
        return redirect()->route('client.home');
    }
}
