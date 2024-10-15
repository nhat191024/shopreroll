<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\GameRechargeService;
use Illuminate\Http\Request;

class GameRechargeController extends Controller
{
    private $gameRechargeService;

    public function __construct()
    {
        $this->gameRechargeService = app(GameRechargeService::class);
    }

    public function index()
    {
        $allGameRecharge = $this->gameRechargeService->getAll();
        return view('admin.gameRecharge.GameRecharge', compact('allGameRecharge'));
    }

    public function showAddRecharge()
    {
        return view('admin.gameRecharge.add_recharge');
    }

    public function addRecharge(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tutorial' => 'required',
            'recharge_image' => 'required'
        ]);
        // Public Folder
        $imageName = time() . '_' . $request->recharge_image->getClientOriginalName();
        $request->recharge_image->move(public_path('image/thumb'), $imageName);
        $this->gameRechargeService->add($request->name, $request->tutorial, $request->id_youtube, $imageName);
        return redirect(route('admin.GameRecharge.index'))->with('success', 'Thêm game recharge thành công');
    }

    public function showEditRecharge(Request $request)
    {
        $id = $request->id;
        $gameRechargeInfo = $this->gameRechargeService->getById($id);
        return view('admin.gameRecharge.edit_recharge', compact('id', 'gameRechargeInfo'));
    }

    public function editRecharge(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tutorial' => 'required'
        ]);
        $gameRecharge = $this->gameRechargeService->getById($request->id);
        $imageName = $gameRecharge->image;

        if ($request->hasFile('recharge_image')) {
            $imageName = time() . '_' . $request->recharge_image->getClientOriginalName();
            $request->recharge_image->move(public_path('image/thumb'), $imageName);
            if ($gameRecharge->image && file_exists(public_path('image/thumb') . '/' . $gameRecharge->image)) {
                unlink(public_path('image/thumb') . '/' . $gameRecharge->image);
            }
        }
        $this->gameRechargeService->edit($request->id, $request->name, $request->tutorial, $request->id_youtube, $imageName);
        return redirect(route('admin.recharge.index'))->with('success', 'Sửa game recharge thành công');
    }

    public function ChangeGameStatus($id, $status)
    {
        if ($this->gameRechargeService->checkHasChildren($id)) {
            return redirect(route('admin.GameRecharge.index'))->with('error', 'Game này đang có sản phẩm không thể ẩn');
        }

        switch ($status) {
            case 1:
                $this->gameRechargeService->ChangeStatus($id, 1);
                return redirect(route('admin.GameRecharge.index'))->with('success', 'Hiện game thành công');
                break;
            case 0:
                $this->gameRechargeService->ChangeStatus($id, 0);
                return redirect(route('admin.GameRecharge.index'))->with('success', 'Ẩn game thành công');
                break;
        }
    }
}
