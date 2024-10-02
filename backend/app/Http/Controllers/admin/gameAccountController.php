<?php

namespace App\Http\Controllers\admin;

use App\Service\admin\GameAccountService;
use Illuminate\Http\Request;

class GameAccountController
{
    private $gameAccountService;
    public function __construct(GameAccountService $gameAccountService)
    {
        $this->gameAccountService = $gameAccountService;
    }

    public function index()
    {
        $gameAccounts = $this->gameAccountService->getAll();
        return view('admin.game-account.index', compact('gameAccounts'));
    }
    public function showEditGameAccount($id)
    {
        $gameAccount = $this->gameAccountService->getById($id);
        return view('admin.game-account.edit', compact('gameAccount'));
    }
    public function showDetailGameAccount($id)
    {
        $gameAccount = $this->gameAccountService->getById($id);
        return view('admin.game-account.detail', compact('gameAccount'));
    }
    public function showAddGameAccount()
    {
        return view('admin.game-account.add');
    }

    public function editGameAccount(Request $request)
    {
        $this->gameAccountService->edit($request->id, $request);
        return redirect()->route('admin.gameAccount.index')->with('success', 'Cập nhật thành công');
    }
    public function addGameAccount(Request $request)
    {
        $this->gameAccountService->store($request);
        return redirect()->route('admin.gameAccount.index')->with('success', 'Thêm mới thành công');
    }
    public function deleteGameAccount($id)
    {
        $gameAccount = $this->gameAccountService->delete($id);
        return redirect()->route('admin.gameAccount.index')->with('success', 'Cập nhật trạng thái thành công');
    }
}
