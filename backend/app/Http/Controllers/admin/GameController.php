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
        return view('admin.game.Game', compact('allGame'));
    }

    public function showAddGame()
    {
        return view('admin.game.AddGame');
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
        if ($this->gameService->checkHasChildren($id)) {
            return redirect(route('admin.game.index'))->with('error', 'Game này đang có sản phẩm không thể xóa');
        }

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
