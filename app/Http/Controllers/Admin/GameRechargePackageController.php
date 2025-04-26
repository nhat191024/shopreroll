<?php

namespace App\Http\Controllers\Admin;

use App\Models\RechargePackage;
use App\Models\GameRecharge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameRechargePackageController extends Controller
{
    public function index($id)
    {
        $rechargePackages = RechargePackage::where('game_recharge_id', $id)->get();
        $rechargeName = GameRecharge::find($id)->name;
        return view('admin.gameRechargePackage.GameRechargePackage', compact('id', 'rechargePackages', 'rechargeName'));
    }

    public function create()
    {
        $gameRecharges = GameRecharge::all();
        return view('admin.gameRechargePackage.AddGameRechargePackage', compact('gameRecharges'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'game_recharge_id' => 'required'
        ]);

        RechargePackage::create([
            'game_recharge_id' => $request->game_recharge_id,
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect()->route('admin.gameRechargePackage.index', $request->game_recharge_id)->with('success', 'Thêm gói nạp thành công');
    }

    public function edit($id)
    {
        $gameRecharges = GameRecharge::all();
        $package = RechargePackage::find($id);
        return view('admin.gameRechargePackage.EditGameRechargePackage', compact('gameRecharges', 'package'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'price' => 'required',
            'name' => 'required',
            'game_recharge_id' => 'required',
        ]);

        RechargePackage::where('id', $request->id)->update([
            'game_recharge_id' => $request->game_recharge_id,
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect(route('admin.gameRechargePackage.index', $request->game_recharge_id))->with('success', 'Sửa gói nạp thành công');
    }

    public function destroy($id, $status)
    {
        $text = $status == 1 ? 'hiện' : 'ẩn';
        RechargePackage::where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with('success', 'Gói nạp đã được ' . $text);
    }
}
