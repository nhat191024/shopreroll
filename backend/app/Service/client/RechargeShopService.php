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

    public function getAllRechargeBillsByUser()
    {
        $user = Auth::user();
        $result = RechargeBill::where('user_id', $user->id)->get();
        return $result;
    }

    public function rechargeConfirm(Request $request)
    {
        // dd('Đã nhận yêu cầu nạp tiền (muốn thêm vào DB phải comment dd() đi, File: RechargeShopService.php line 40): ',$request->all());

        $rechargeBill = new RechargeBill();
        $rechargeBill->user_id = Auth::id();
        $rechargeBill->recharge_package_id = $request->recharge_packet_order;
        $rechargeBill->UID = $request->uid;
        $rechargeBill->username = $request->login_name;
        $rechargeBill->password = $request->pass;
        $rechargeBill->server = $request->game_server;
        $rechargeBill->character_name = $request->character_name;
        $rechargeBill->phone = $request->phone;
        $rechargeBill->note = $request->note;
        $rechargeBill->save();
        dd('Nạp tiền thành công?');
        return $rechargeBill;
    }
}
