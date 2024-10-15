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
    private $categoryService;
    private $gameService;
    //
    public function __construct(GameCategoryService $categoryService, GameService $gameService)
    {
        $this->categoryService = $categoryService;
        $this->gameService = $gameService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return view('admin.category.category', compact('categories'));
    }

    public function showAddCategory()
    {
        $game = $this->gameService->getAll();
        return view('admin.category.add_category', compact('game'));
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
        $this->categoryService->add($request->category_name, $imageName, $request->game_id);
        return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công');
    }

    public function showEditCategory(Request $request)
    {
        $id = $request->id;
        $game = $this->gameService->getAll();
        $gameCategoryInfo = $this->categoryService->getById($id);
        return view('admin.category.edit_category', compact('id', 'game', 'gameCategoryInfo'));
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
            $oldImagePath = $this->categoryService->getById($request->category_id)->image;
            if (file_exists(public_path('image/thumb') . '/' . $oldImagePath) && $oldImagePath != null) {
                unlink(public_path('image/thumb') . '/' . $oldImagePath);
            }
        }
        $this->categoryService->edit($request->category_id, $request->category_name, $imageName, $request->game_id);
        return redirect(route('admin.category.index'))->with('success', 'Sửa danh mục thành công');
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->id;
        if (!$this->categoryService->checkHasChildren($id)) {
            $this->categoryService->delete($id);
            return redirect(route('admin.category.index'))->with('success', 'Xóa danh mục thành công');
        }
        return redirect(route('admin.category.index'))->with('error', 'Danh mục đang có sản phẩm không thể xóa');
    }
}
