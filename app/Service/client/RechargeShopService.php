<?php

namespace App\Service\client;

use App\Models\AccountBill;
use App\Models\Game;
use App\Models\GameRecharge;
use App\Models\RechargeBill;
use App\Models\RechargePackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RechargeShopService
{
    public function getAllRechargePackagesByRechargeId($id)
    {
        return RechargePackage::where('game_recharge_id', $id)->get();
    }

    public function getCurrentGameRechargeById($id)
    {
        if (is_null($id)) {
            return new GameRecharge();
        }
        $result = GameRecharge::find($id);
        // dd($result);
        return $result;
    }

    public function getAllRechargeBillsByUser($gameRechargeId)
    {
        $user = Auth::user();
        $result = RechargeBill::whereHas('rechargePackage', function($query) use ($gameRechargeId) {
            $query->where('game_recharge_id', $gameRechargeId);
        })->where('user_id', $user->id)->get();
        return $result;
    }

    public function rechargeConfirm(Request $request)
    {
        $buyPackage = RechargePackage::find($request->recharge_packet_id);
        if (!$buyPackage) return redirect()->back()->with('error', 'Gói mua đó không còn khả dụng!');

        $user = Auth::user();
        // Check if user has enough balance
        if ($user->balance < $buyPackage->price) {
            return redirect()->back()->with('error', 'Số dư không đủ để thực hiện giao dịch!');
        }

        $rechargeBill = new RechargeBill();
        $rechargeBill->user_id = Auth::id();
        $rechargeBill->recharge_package_id = $request->recharge_packet_id;
        $rechargeBill->UID = $request->uid;
        $rechargeBill->username = $request->login_name;
        $rechargeBill->password = $request->pass;
        $rechargeBill->server = $request->game_server;
        $rechargeBill->character_name = $request->character_name;
        $rechargeBill->phone = $request->phone;
        $rechargeBill->note = $request->note;
        $rechargeBill->save();

        // trừ tiền trong tài khoản của user
        $user->balance -= $buyPackage->price;
        $user->save();
        
        return $request->game_recharge_id;
    }
}
