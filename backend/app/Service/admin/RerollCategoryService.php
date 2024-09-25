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

    public function add($name, $image, $note)
    {
        RerollCategory::create([
            'name'=> $name,
            'image'=> $image,
            'note'=> $note,
        ]);
    }

    public function edit($id, $name, $note)
    {
        $rollCategory = RerollCategory::where('id', $id)->first();
        $rollCategory['name'] = $name;
        $rollCategory['note'] = $note;
        // $rollCategory['status'] = $status;
        $rollCategory->save();
    }

    // public function checkHasChildren($idCategory) {
    //     return RerollCategory::find($idCategory)->products()->get()->count() > 0;
    // }

    public function delete($idRerollCategory) {
        $rollCategory = RerollCategory::where('id', $idRerollCategory)->first();
        $rollCategory['status'] = 1;
        $rollCategory->save();
    }
}
