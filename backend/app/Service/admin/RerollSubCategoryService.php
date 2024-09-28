<?php

namespace App\Service\admin;

use App\Models\RerollSubCategory;

class RerollSubCategoryService
{
    public function getAll()
    {
        $rerollSubCategory = RerollSubCategory::all();
        return $rerollSubCategory;
    }

    public function getById($id) {
        return RerollSubCategory::where('id', $id)->first();
    }

    public function add($rerollCategoryId, $name, $tutorial, $idYoutube, $fileDownloadLink, $image)
    {
        RerollSubCategory::create([
            'reroll_category_id' => $rerollCategoryId,
            'name' => $name,
            'tutorial' => $tutorial,
            'id_youtube' => $idYoutube,
            'file_download_link' => $fileDownloadLink,
            'image' => $image,
        ]);
        
    }

    public function edit($id, $rerollCategoryId, $name, $tutorial, $idYoutube, $fileDownloadLink)
    {
        // Find the RerollSubCategory by ID
        $rerollSubCategory = RerollSubCategory::find($id);
    
        // Check if the record exists
        if ($rerollSubCategory) {
            $rerollSubCategory->reroll_category_id = $rerollCategoryId;
            $rerollSubCategory->name = $name;
            $rerollSubCategory->tutorial = $tutorial;
            $rerollSubCategory->id_youtube = $idYoutube;
            $rerollSubCategory->file_download_link = $fileDownloadLink;
    
            // Save the changes
            $rerollSubCategory->save();
        } else {
            // Handle the case where the record is not found
            throw new \Exception("RerollSubCategory not found");
        }
    }
    

    public function checkHasChildren($idRerollSubCategory) {
        $subCategory = RerollSubCategory::find($idRerollSubCategory);
        return RerollSubCategory::find($idRerollSubCategory)->RerollPackage()->get()->count() >0;
    }

    public function delete($idRerollSubCategory) {
        $rollSubCategory = RerollSubCategory::where('id', $idRerollSubCategory)->first();
        $rollSubCategory['status'] = 1;
        $rollSubCategory->save();
    }
}
