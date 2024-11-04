<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\admin\GameAccountService;
use Illuminate\Support\Facades\Validator;

class GameAccountController extends Controller
{
    protected $gameAccountService;

    public function __construct(GameAccountService $gameAccountService)
    {
        $this->gameAccountService = $gameAccountService;
    }

    public function index()
    {
        $gameAccounts = $this->gameAccountService->getAllGameAccounts();
        return view('admin.game_accounts.index', compact('gameAccounts'));
    }

    public function showAddForm()
    {
        $gameCategories = $this->gameAccountService->getAllGameCategories();
        return view('admin.game_accounts.add', compact('gameCategories'));
    }

    public function addGameAccount(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'server' => 'required|string',
            'ar' => 'required|integer',
            'game_category_id' => 'required',
            'price_in' => 'nullable|numeric',
            'price_out' => 'required|numeric',
            'note' => 'nullable|string',
            'account_image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->all();
            $this->gameAccountService->addGameAccount($data);
            return redirect()->route('admin.gameAccount.index')->with('success', 'Thêm tài khoản game thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage())->withInput();
        }
    }

    public function editGameAccount($id, Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'server' => 'required|string',
            'ar' => 'required|integer',
            'game_category_id' => 'required|exists:game_categories,id',
            'price_in' => 'nullable|numeric',
            'price_out' => 'required|numeric',
            'note' => 'nullable|string',
            'account_image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->all();
            $this->gameAccountService->editGameAccount($id, $data);
            return redirect()->route('admin.gameAccount.index')->with('success', 'Cập nhật tài khoản game thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage())->withInput();
        }
    }

    public function showEditForm($id)
    {
        $gameAccount = $this->gameAccountService->getGameAccountById($id);
        $gameCategories = $this->gameAccountService->getAllGameCategories();
        return view('admin.game_accounts.edit', compact('gameAccount', 'gameCategories'));
    }

    public function disableGameAccount($id)
    {
        try {
            $this->gameAccountService->disableGameAccount($id);
            return redirect()->route('admin.gameAccount.index')->with('success', 'Tài khoản game đã bị vô hiệu hóa');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function storeGameAccount($id)
    {
        try {
            $this->gameAccountService->storeGameAccount($id);
            return redirect()->route('admin.gameAccount.index')->with('success', 'Tài khoản game đã được khôi phục');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function getGameDetails($categoryId)
    {
        try {
            $result = $this->gameAccountService->getGameDetails($categoryId);
            return response()->json(['success' => true, 'data' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }
}
