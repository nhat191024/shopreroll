<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\GameRechargeService;
use App\Service\admin\RechargePackageService;
use Illuminate\Http\Request;

class RechargePackageController extends Controller
{
    private $rechargePackageService;
    private $gameRechargeService;
    //
    public function __construct(RechargePackageService $rechargePackageService, GameRechargeService $gameRechargeService)
    {
        $this->rechargePackageService = $rechargePackageService;
        $this->gameRechargeService = $gameRechargeService;
    }

    public function index()
    {
        $rechargePackages = $this->rechargePackageService->getAll();
        return view('admin.rechargePackage.recharge_package', compact('rechargePackages'));
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

    public function deleteRechargePackage(Request $request)
    {
        $id = $request->id;
        if (!$this->rechargePackageService->checkHasChildren($id)) {
            $this->rechargePackageService->delete($id);
            return redirect(route('admin.package.index'))->with('success', 'Xóa gói nạp thành công');
        }
        return redirect(route('admin.package.index'))->with('error', 'Gói nạp đang có sản phẩm không thể xóa');
    }
}
