<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\GameRechargeService;
use App\Service\admin\GameRechargePackageService;
use Illuminate\Http\Request;

class GameRechargePackageController extends Controller
{
    private $rechargePackageService;
    private $gameRechargeService;

    public function __construct()
    {
        $this->rechargePackageService = app(GameRechargePackageService::class);
        $this->gameRechargeService = app(GameRechargeService::class);
    }

    public function index($id)
    {
        $rechargePackages = $this->rechargePackageService->getByGameRechargeId($id);
        return view('admin.gameRechargePackage.GameRechargePackage', compact('rechargePackages'));
    }

    public function showAddRechargePackage()
    {
        $gameRecharge = $this->gameRechargeService->getAll();
        return view('admin.rechargePackage.add_recharge_package', compact('gameRecharge'));
    }

    public function addRechargePackage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'game_recharge_id' => 'required',
            'price' => 'required'
        ]);
        $this->rechargePackageService->add($request->game_recharge_id, $request->name, $request->price);
        return redirect()->route('admin.package.index')->with('success', 'Thêm gói nạp thành công');
    }

    public function showEditRechargePackage(Request $request)
    {
        $id = $request->id;
        $game = $this->gameRechargeService->getAll();
        $package = $this->rechargePackageService->getById($id);
        return view('admin.rechargePackage.edit_recharge_package', compact('id', 'game', 'package'));
    }

    public function editRechargePackage(Request $request)
    {
        $request->validate([
            'price' => 'required',
            'name' => 'required',
            'game_recharge_id' => 'required',
            'id' => 'required'
        ]);
        $this->rechargePackageService->edit($request->id, $request->game_recharge_id, $request->name, $request->price);
        return redirect(route('admin.package.index'))->with('success', 'Sửa gói nạp thành công');
    }

    public function ChangeGameRechargePackageStatus($id, $status)
    {
        switch ($status) {
            case 1:
                $this->rechargePackageService->ChangeStatus($id, 1);
                return redirect()->back()->with('success', 'Hiện game thành công');
                break;
            case 0:
                $this->rechargePackageService->ChangeStatus($id, 0);
                return redirect()->back()->with('success', 'Ẩn game thành công');
                break;
        }
    }
}
