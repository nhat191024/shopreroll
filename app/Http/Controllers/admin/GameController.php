<?php

namespace App\Http\Controllers\admin;

use App\Models\GameItemType;
use App\Models\GameAttribute;
use App\Models\Game;

use App\Http\Controllers\Controller;
use App\Service\admin\GameService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //
    private $gameService;
    //
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function index()
    {
        $games = Game::withCount('gameItemType', 'gameAttribute')->get();
        return view('admin.game.game', compact('games'));
    }

    public function showAddGame()
    {
        return view('admin.game.AddGame');
    }

    public function addGame(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'game_item.*' => 'required|string|max:255',
            'game_attribute.*' => 'required|string|max:255',
        ]);

        $game = Game::create([
            'name' => $request->name
        ]);

        foreach ($request->game_item as $item) {
            GameItemType::create([
                'game_id' => $game->id,
                'name' => $item
            ]);
        }

        foreach ($request->game_attribute as $attribute) {
            GameAttribute::create([
                'game_id' => $game->id,
                'name' => $attribute
            ]);
        }

        return redirect(route('admin.game.index'))->with('success', 'Thêm game thành công');
    }

    public function showEditGame(Request $request)
    {
        $id = $request->id;
        $gameInfo = $this->gameService->getById($id);
        return view('admin.game.EditGame', compact('id', 'gameInfo'));
    }

    public function editGame(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);
        // Public Folder
        $this->gameService->edit($request->id, $request->name);
        return redirect(route('admin.game.index'))->with('success', 'Sửa game thành công');
    }

    public function ChangeGameStatus($id, $status)
    {
        switch ($status) {
            case 1:
                $this->gameService->ChangeStatus($id, 1);
                return redirect(route('admin.game.index'))->with('success', 'Hiện game thành công');
                break;
            case 0:
                $this->gameService->ChangeStatus($id, 0);
                return redirect(route('admin.game.index'))->with('success', 'Ẩn game thành công');
                break;
        }
    }
}
