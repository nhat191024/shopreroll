<?php

namespace App\Service\admin;

use App\Models\RerollKey;

class RerollKeyService
{
    public function getAll()
    {
        return RerollKey::all();
    }

    public function getById($id) {
        return RerollKey::find($id);
    }

    public function add($key, $reroll_package_id)
    {
        RerollKey::create([
            'key' => $key,
            'reroll_package_id' => $reroll_package_id
        ]);
    }

    public function edit($id, $key)
    {
        // Find the RerollKey by ID
        $rerollKey = RerollKey::find($id);

        // Check if the record exists
        if ($rerollKey) {
            $rerollKey->key = $key;

            // Save the changes
            $rerollKey->save();
        } else {
            // Handle the case where the record is not found
            throw new \Exception("RerollKey not found");
        }
    }

    public function checkHasChildren($idRerollKey) {
        // Check if there are associated RerollBill records
        return RerollKey::find($idRerollKey)->RerollBill()->exists();
    }

    public function getChildren($idRerollKey) {
        // Retrieve associated RerollBill records
        return RerollKey::find($idRerollKey)->RerollBill()->get();
    }

    public function delete($id) {
        RerollKey::destroy($id);
    }
}
