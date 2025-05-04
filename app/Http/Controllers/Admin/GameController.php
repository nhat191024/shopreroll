<?php

namespace App\Http\Controllers\Admin;

use App\Models\GameItemType;
use App\Models\GameAttribute;
use App\Models\Game;

use App\Http\Controllers\Controller;
use App\Service\admin\GameService;
use Illuminate\Http\Request;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;

class GameController extends Controller
{
    private $gameService;

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

    public function addGame(StoreGameRequest $request)
    {
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

    public function showEditGame($id)
    {
        $game = Game::find($id)->load('gameItemType', 'gameAttribute');
        return view('admin.game.EditGame', compact('game'));
    }

    public function editGame(UpdateGameRequest $request, $id)
    {
        $game = Game::find($id)->load('GameAccount', 'gameItemType', 'gameAttribute');

        if ($game->GameAccount->count() > 0) {
            return redirect()->back()->with('error', 'Không thể sửa do game đang chứa tài khoản game');
        }

        $game->name = $request->name;
        $game->save();

        $game->gameItemType()->delete();
        foreach ($request->game_item as $item) {
            GameItemType::create([
                'game_id' => $game->id,
                'name' => $item
            ]);
        }

        $game->gameAttribute()->delete();
        foreach ($request->game_attribute as $attribute) {
            GameAttribute::create([
                'game_id' => $game->id,
                'name' => $attribute
            ]);
        }

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
