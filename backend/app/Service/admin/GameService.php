<?php

namespace App\Service\admin;

use App\Models\Game;

class GameService
{
    public function getAll()
    {
        $game = Game::all();
        return $game;
    }

    public function getById($id)
    {
        return Game::where('id', $id)->first();
    }

    public function add($name)
    {
        Game::create([
            'name' => $name
        ]);
    }

    public function edit($id, $name)
    {
        $game = Game::where('id', $id)->first();
        $game->name = $name;
        $game->save();
    }

    public function checkHasChildren($idgame)
    {
        return Game::find($idgame)->GameCategory()->get()->count() > 0;
    }

    public function delete($idgame)
    {
        Game::destroy($idgame);
    }
}
