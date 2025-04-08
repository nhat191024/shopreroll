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

    public function index($game)
    {
        $categories = GameCategory::where('game_id', $game)->get();
        $gameName = Game::where('id', $game)->first()->name;
        return view('admin.gameCategory.GameCategory', compact('game', 'categories', 'gameName'));
    }

    public function create()
    {
        $game = Game::all();
        return view('admin.gameCategory.AddGameCategory', compact('game'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'game_id' => 'required',
            'image' => 'required'
        ]);

        $imagePath = null;
        if ($request->has('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('image/gameCategory'), $imageName);
            $imagePath = 'image/gameCategory/' . $imageName;
        }

        GameCategory::create([
            'game_id' => $request->game_id,
            'name' => $request->category_name,
            'image' => $imagePath,
            'status' => 1,
        ]);

        return redirect()->route('admin.gameCategory.index', $request->game_id)->with('success', 'Thêm danh mục thành công');
    }

    public function edit($id)
    {
        $game = Game::all();
        $gameCategory = GameCategory::find($id);
        return view('admin.gameCategory.EditGameCategory', compact('id', 'game', 'gameCategory'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'game_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gameCategory = GameCategory::find($id);

        $imagePath = $gameCategory->image;
        if ($request->has('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('image/gameCategory'), $imageName);
            $imagePath = 'image/gameCategory/' . $imageName;
        }

        $gameCategory->update([
            'game_id' => $request->game_id,
            'name' => $request->category_name,
            'image' => $imagePath,
            'status' => 1,
        ]);

        return redirect(route('admin.gameCategory.index', $request->game_id))->with('success', 'Sửa danh mục thành công');
    }

    public function destroy($id, $status)
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
