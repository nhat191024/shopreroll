<?php

namespace App\Service\admin;

use App\Models\GameRecharge;

class GameRechargeService
{
    public function getAll()
    {
        $gameRecharge = GameRecharge::all();
        return $gameRecharge;
    }

    public function getById($id)
    {
        return GameRecharge::where('id', $id)->first();
    }

    public function add($name, $tutorial, $id_youtube, $image)
    {
        GameRecharge::create([
            'name' => $name,
            'tutorial' => $tutorial,
            'id_youtube' => $id_youtube,
            'image' => $image
        ]);
    }

    public function edit($id, $name, $tutorial, $id_youtube, $image)
    {
        $gameRecharge = GameRecharge::where('id', $id)->first();
        $gameRecharge->name = $name;
        $gameRecharge->tutorial = $tutorial;
        $gameRecharge->id_youtube = $id_youtube;
        $gameRecharge->image = $image;
        $gameRecharge->save();
    }

    public function checkHasChildren($id)
    {
        return GameRecharge::find($id)->RechargePackages()->get()->count() > 0;
    }

    public function getChildren($id)
    {
        return GameRecharge::find($id)->RechargePackages()->get();
    }

    public function ChangeStatus($id, $status)
    {
        $gameRecharge = GameRecharge::where('id', $id)->first();
        $gameRecharge->status = $status;
        $gameRecharge->save();
    }
}
