<?php

namespace App\Service\admin;

use App\Models\GameCategory;

class CategoryService
{
    public function getAll()
    {
        $category = GameCategory::all();
        return $category;
    }

    public function getById($id)
    {
        return GameCategory::where('id', $id)->first();
    }

    public function add($categoryName, $image, $gameId)
    {
        GameCategory::create([
            'name' => $categoryName,
            'image' => $image,
            'game_id' => $gameId
        ]);
    }

    public function edit($id, $categoryName, $image, $gameId)
    {
        $category = GameCategory::where('id', $id)->first();
        $category->name = $categoryName;
        if ($image != null) {
            $category->image = $image;
        }
        $category->game_id = $gameId;
        $category->save();
    }

    public function checkHasChildren($idCategory)
    {
        return GameCategory::find($idCategory)->GameAccount()->get()->count() > 0;
    }

    public function delete($idCategory)
    {
        $category = GameCategory::where('id', $idCategory)->first();
        $category->status = 0;
        $category->save();
    }
}
