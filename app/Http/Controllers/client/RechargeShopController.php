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
        $rechargeBills = $this->rechargeShopService->getAllRechargeBillsByUser($gameRecharge->id);
        return view('client.home.game-recharge', compact('rechargePackages','gameRecharge', 'rechargeBills'));
    }

    public function rechargeConfirm(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $game_recharge_id = $this->rechargeShopService->rechargeConfirm($request);

        return redirect()->route('client.recharge', ['id' => $game_recharge_id])
            ->with('success', 'Đã gửi yêu cầu nạp!');;
    }
}
