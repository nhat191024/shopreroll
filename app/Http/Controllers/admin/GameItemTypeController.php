<?php

namespace App\Http\Controllers\admin;

use App\Models\Game;
use App\Models\GameItemType;

use App\Http\Requests\StoreGameItemTypeRequest;
use App\Http\Requests\UpdateGameItemTypeRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameItemTypeController extends Controller
{
    public function index($gameId)
    {
        $gameItemTypes = GameItemType::where('game_id', $gameId)->get();
        $gameName = Game::find($gameId)->name;
        return view('admin.game_item_type.index', compact('gameItemTypes', 'gameName', 'gameId'));
    }

    public function create($gameId)
    {
        $gameName = Game::find($gameId)->name;
        return view('admin.game_item_type.add', compact('gameId', 'gameName'));
    }

    public function store(StoreGameItemTypeRequest $request)
    {
        foreach ($request->game_item as $value) {
            GameItemType::create([
                'game_id' => $request->game_id,
                'name' => $value,
            ]);
        }

        return redirect()->route('admin.game_item_type.index', $request->game_id)->with('success', 'Game Item Type added successfully');
    }

    public function edit($id)
    {
        $gameItemType = GameItemType::find($id);
        return view('admin.game_item_type.update', compact('gameItemType'));
    }

    public function update(UpdateGameItemTypeRequest $request, $id)
    {
        $gameItemType = GameItemType::find($id);
        $gameItemType->name = $request->name;
        $gameItemType->save();

        return redirect()->route('admin.game_item_type.index', $gameItemType->game_id)->with('success', 'Game Item Type updated successfully');
    }

    public function destroy($id)
    {
        $gameItemType = GameItemType::find($id);
        $gameId = $gameItemType->game_id;

        if ($gameItemType->gameItems->count() > 0) {
            return redirect()->route('admin.game_item_type.index', $gameId)->with('error', 'Game Item Type has game items, cannot delete');
        }

        $gameItemType->delete();
        return redirect()->route('admin.game_item_type.index', $gameId)->with('success', 'Game Item Type deleted successfully');
    }
}
