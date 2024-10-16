<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameCategory;
use App\Service\admin\GameCategoryService;
use App\Service\admin\GameService;
use Illuminate\Http\Request;

class GameCategoryController extends Controller
{
    private $gameCategoryService;
    private $gameService;

    public function __construct()
    {
        $this->gameCategoryService = app(GameCategoryService::class);
        $this->gameService = app(GameService::class);
    }

    public function index($id)
    {
        $categories = $this->gameCategoryService->getByGameId($id);
        $gameName = Game::where('id', $id)->first()->name;
        return view('admin.gameCategory.GameCategory', compact('categories', 'gameName'));
    }

    public function showAddCategory()
    {
        $game = $this->gameService->getAll();
        return view('admin.gameCategory.AddGameCategory', compact('game'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'game_id' => 'required',
            'category_image' => 'required'
        ]);
        $imageName = time() . '_' . $request->category_image->getClientOriginalName();
        $request->category_image->move(public_path('image/thumb'), $imageName);
        $this->gameCategoryService->add($request->category_name, $imageName, $request->game_id);
        return redirect()->route('admin.GameCategory.index', $request->game_id)->with('success', 'Thêm danh mục thành công');
    }

    public function showEditCategory(Request $request)
    {
        $id = $request->id;
        $game = $this->gameService->getAll();
        $gameCategoryInfo = $this->gameCategoryService->getById($id);
        return view('admin.gameCategory.EditGameCategory', compact('id', 'game', 'gameCategoryInfo'));
    }

    public function editCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'game_id' => 'required',
            'category_id' => 'required',
        ]);
        $imageName = null;
        if ($request->category_image) {
            $imageName = time() . '_' . $request->category_image->getClientOriginalName();
            $request->category_image->move(public_path('image/thumb'), $imageName);
            $oldImagePath = $this->gameCategoryService->getById($request->category_id)->image;
            if (file_exists(public_path('image/thumb') . '/' . $oldImagePath) && $oldImagePath != null) {
                unlink(public_path('image/thumb') . '/' . $oldImagePath);
            }
        }
        $this->gameCategoryService->edit($request->category_id, $request->category_name, $imageName, $request->game_id);
        return redirect(route('admin.GameCategory.index', $request->game_id))->with('success', 'Sửa danh mục thành công');
    }

    public function ChangeGameCategoryStatus($id, $status)
    {
        switch ($status) {
            case 1:
                $this->gameCategoryService->ChangeStatus($id, 1);
                return redirect()->back()->with('success', 'Hiện game thành công');
                break;
            case 0:
                $this->gameCategoryService->ChangeStatus($id, 0);
                return redirect()->back()->with('success', 'Ẩn game thành công');
                break;
        }
    }
}
