<?php

namespace App\Http\Controllers\admin;

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
        $allGame = $this->gameService->getAll();
        return view('admin.game.game', compact('allGame'));
    }

    public function showAddGame()
    {
        return view('admin.game.add_game');
    }

    public function addGame(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        // Public Folder
        $this->gameService->add($request->name);
        return redirect(route('admin.game.index'))->with('success', 'Thêm game thành công');
    }

    public function showEditGame(Request $request)
    {
        $id = $request->id;
        $gameInfo = $this->gameService->getById($id);
        return view('admin.game.edit_game', compact('id', 'gameInfo'));
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

    public function deleteGame(Request $request)
    {
        $id = $request->id;
        if (!$this->gameService->checkHasChildren($id)) {
            $this->gameService->delete($id);
            return redirect(route('admin.game.index'))->with('success', 'Xóa game thành công');
        }
        return redirect(route('admin.game.index'))->with('error', 'Game này đang có sản phẩm không thể xóa');
    }
}
