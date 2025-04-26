<?php

namespace App\Http\Controllers\admin;

use App\Models\GameRecharge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameRechargeController extends Controller
{
    public function index()
    {
        $gameRecharges = GameRecharge::all();
        return view('admin.gameRecharge.GameRecharge', compact('gameRecharges'));
    }

    public function create()
    {
        return view('admin.gameRecharge.AddGameRecharge');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tutorial' => 'required',
            'image' => 'required'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('image/recharges'), $imageName);
            $imageName = 'image/recharges/' . $imageName;
        }

        GameRecharge::create([
            'name' => $request->name,
            'tutorial' => $request->tutorial,
            'id_youtube' => $request->id_youtube ?? null,
            'image' => $imageName
        ]);

        return redirect(route('admin.gameRecharge.index'))->with('success', 'Thêm game recharge thành công');
    }

    public function edit($id)
    {
        $gameRecharge = GameRecharge::find($id);
        return view('admin.gameRecharge.EditGameRecharge', compact('gameRecharge'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tutorial' => 'required'
        ]);

        $gameRecharge = GameRecharge::findOrFail($id);
        $imagePath = $gameRecharge->image;

        if ($request->hasFile('image')) {
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/recharges'), $imageName);
            $imagePath = 'image/recharges/' . $imageName;
        }

        $gameRecharge->update([
            'name' => $request->name,
            'tutorial' => $request->tutorial,
            'id_youtube' => $request->id_youtube ?? null,
            'image' => $imagePath
        ]);

        return redirect(route('admin.gameRecharge.index'))->with('success', 'Sửa game recharge thành công');
    }

    public function changeStatus($id, $status)
    {
        $gameRecharge = GameRecharge::find($id);

        if ($gameRecharge->RechargePackages()->exists()) {
            return redirect(route('admin.gameRecharge.index'))
                ->with('error', 'Game này đang có sản phẩm không thể ẩn');
        }

        $statusText = $status == 1 ? 'Hiện' : 'Ẩn';

        $gameRecharge->update(['status' => $status]);

        return redirect(route('admin.gameRecharge.index'))
            ->with('success', $statusText . ' game thành công');
    }
}
