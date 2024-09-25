<?php

namespace App\Service\admin;

use App\Models\RerollCategory;

class RerollCategoryService
{
    public function getAll()
    {
        $rerollCategory = RerollCategory::all();
        return $rerollCategory;
    }

    public function getById($id) {
        return RerollCategory::where('id', $id)->first();
    }

    public function add($name, $image, $note, $status)
    {
        RerollCategory::create([
            'name'=> $name,
            'image'=> $image,
            'note'=> $note,
            'status'=> $status
        ]);
    }

    public function edit($id, $name, $image, $note, $status)
    {
        $rollCategory = RerollCategory::where('id', $id)->first();
        $rollCategory->$name;
        $rollCategory->$image;
        $rollCategory->$note;
        $rollCategory->$status;
        $rollCategory->save();
    }

    // public function checkHasChildren($idCategory) {
    //     return RerollCategory::find($idCategory)->products()->get()->count() > 0;
    // }

    public function delete($idRerollCategory) {
        RerollCategory::destroy($idRerollCategory);
    }
}
