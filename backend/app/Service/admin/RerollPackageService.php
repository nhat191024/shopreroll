<?php

namespace App\Service\admin;

use App\Models\RerollPackage;

class RerollPackageService
{
    public function getAll()
    {
        $RerollPackage = RerollPackage::all();
        return $RerollPackage;
    }

    public function getById($id) {
        return RerollPackage::where('id', $id)->first();
    }

    public function add($reroll_sub_category_id, $name, $price)
    {
        // $imageName = time() . '_' . $image->getClientOriginalName();
        // $image->move(public_path('image/thumb/'), $imageName);

        RerollPackage::create([
            'reroll_sub_category_id'=> $reroll_sub_category_id,
            'name'=> $name,
            'price' => $price,
        ]);

    }

    public function edit($id, $reroll_sub_category_id, $name, $price)
    {
        // Find the RerollPackage by ID
        $rerollPackage = RerollPackage::find($id);

        // Check if the record exists
        if ($rerollPackage) {
            $rerollPackage->reroll_sub_category_id = $reroll_sub_category_id;
            $rerollPackage->name = $name;
            $rerollPackage->price = $price;
  

            // Save the changes
            $rerollPackage->save();
        } else {
            // Handle the case where the record is not found
            throw new \Exception("RerollPackage not found");
        }
    }


    public function checkHasChildren($idRerollPackage) {
        return RerollPackage::find($idRerollPackage)->RerollKey()->get()->count() >0;
    }

    public function delete($id) {
        RerollPackage::destroy($id);
    }
}
