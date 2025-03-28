<?php

namespace App\Http\Controllers\admin;

use App\Models\GameItem;
use App\Models\GameItemType;
use App\Models\Game;
use App\Models\AccountItem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreGameItemRequest;
use App\Http\Requests\UpdateGameItemRequest;

class GameItemController extends Controller
{
    public function index($gameId)
    {
        $gameItems = GameItem::where('game_id', $gameId)->with('gameItemType')->get();
        $gameName = Game::find($gameId)->name;
        return view('admin.game_item.index', compact('gameItems', 'gameName', 'gameId'));
    }

    public function create($gameId)
    {
        $gameName = Game::find($gameId)->name;
        $itemTypes = GameItemType::where('game_id', $gameId)->get();
        return view('admin.game_item.add', compact('gameId', 'gameName', 'itemTypes'));
    }

    public function store(StoreGameItemRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/items'), $imageName);

            $imagePath = 'image/items/' . $imageName;
        }

        GameItem::create([
            'game_id' => $request->game_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'game_item_type_id' => $request->game_item_type_id,
        ]);

        return redirect()->route('admin.game_item.index', $request->game_id)->with('success', 'Game Item added successfully');
    }

    public function edit($id)
    {
        $gameItem = GameItem::find($id);
        $itemTypes = GameItemType::where('game_id', $gameItem->game_id)->get();
        return view('admin.game_item.update', compact('gameItem', 'itemTypes'));
    }

    public function update(UpdateGameItemRequest $request, $id)
    {
        $gameItem = GameItem::find($id);

        $imagePath = $gameItem->image;
        if ($request->hasFile('image')) {
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/items'), $imageName);

            $imagePath = 'image/items/' . $imageName;
        }

        $gameItem->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'game_item_type_id' => $request->game_item_type_id,
        ]);

        return redirect()->route('admin.game_item.index', $gameItem->game_id)->with('success', 'Game Item updated successfully');
    }

    public function destroy($id)
    {

        $gameItem = GameItem::find($id);
        if (AccountItem::where('game_item_id', $id)->exists()) {
            return redirect()->route('admin.game_item.index', $gameItem->game_id)->with('error', 'Game Item cannot be deleted as it is associated with an account');
        }

        $gameId = $gameItem->game_id;
        $gameItem->delete();

        return redirect()->route('admin.game_item.index', $gameId)->with('success', 'Game Item deleted successfully');
    }
}
