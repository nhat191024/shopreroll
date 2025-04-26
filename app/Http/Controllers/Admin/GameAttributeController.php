<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use App\Models\GameAttribute;
use App\Models\AccountAttribute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreGameAttributeRequest;
use App\Http\Requests\UpdateGameAttributeRequest;

class GameAttributeController extends Controller
{
    public function index($gameId)
    {
        $gameAttributes = GameAttribute::where('game_id', $gameId)->get();
        $gameName = Game::find($gameId)->name;
        return view('admin.game_attribute.index', compact('gameAttributes', 'gameName', 'gameId'));
    }

    public function create($gameId)
    {
        $gameName = Game::find($gameId)->name;
        return view('admin.game_attribute.add', compact('gameId', 'gameName'));
    }

    public function store(StoreGameAttributeRequest $request)
    {
        foreach ($request->game_attribute as $attribute) {
            GameAttribute::create([
                'game_id' => $request->game_id,
                'name' => $attribute,
            ]);
        }

        return redirect()->route('admin.game_attribute.index', $request->game_id)->with('success', 'Game Attribute added successfully');
    }

    public function edit($id)
    {
        $gameAttribute = GameAttribute::find($id);
        return view('admin.game_attribute.update', compact('gameAttribute'));
    }

    public function update(UpdateGameAttributeRequest $request, $id)
    {
        $gameAttribute = GameAttribute::find($id);
        $gameAttribute->name = $request->name;
        $gameAttribute->save();

        return redirect()->route('admin.game_attribute.index', $gameAttribute->game_id)->with('success', 'Game Attribute updated successfully');
    }

    public function destroy($id)
    {
        $gameAttribute = GameAttribute::find($id);
        $gameId = $gameAttribute->game_id;

        if (AccountAttribute::where('game_attribute_id', $id)->exists()) {
            return redirect()->route('admin.game_attribute.index', $gameId)->with('error', 'Game Attribute cannot be deleted because it is being used');
        }

        $gameAttribute->delete();
        return redirect()->route('admin.game_attribute.index', $gameId)->with('success', 'Game Attribute deleted successfully');
    }
}
