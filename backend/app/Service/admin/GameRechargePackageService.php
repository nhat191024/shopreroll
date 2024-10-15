<?php

namespace App\Service\admin;

use App\Models\RechargePackage;

class GameRechargePackageService
{
    public function getAll()
    {
        $rechargePackage = RechargePackage::all();
        return $rechargePackage;
    }

    public function getById($id)
    {
        return RechargePackage::where('id', $id)->first();
    }

    public function getByGameRechargeId($game_recharge_id)
    {
        return RechargePackage::where('game_recharge_id', $game_recharge_id)->get();
    }

    public function add($game_recharge_id, $name, $price)
    {
        RechargePackage::create([
            'game_recharge_id' => $game_recharge_id,
            'name' => $name,
            'price' => $price
        ]);
    }

    public function edit($id, $game_recharge_id, $name, $price)
    {
        $rechargePackage = RechargePackage::where('id', $id)->first();
        $rechargePackage->name = $name;
        $rechargePackage->game_recharge_id = $game_recharge_id;
        $rechargePackage->price = $price;
        $rechargePackage->save();
    }

    public function checkHasChildren($id)
    {
        return RechargePackage::find($id)->RechargeBills()->get()->count() > 0;
    }

    public function delete($id)
    {
        $rechargePackage = RechargePackage::where('id', $id)->first();
        $rechargePackage->status = 0;
        $rechargePackage->save();
    }
}
