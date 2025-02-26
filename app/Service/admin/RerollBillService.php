<?php

namespace App\Service\admin;

use App\Models\RerollBill;
use App\Models\User;

class RerollBillService
{
    public function getAll()
    {
        $rerollBill = RerollBill::all();
        return $rerollBill;
    }

    public function getById($id)
    {
        return RerollBill::where('id', $id)->first();
    }

    // public function checkHasChildren($id)
    // {
    //     return User::find($id)->Buyer()->get()->count() > 0;
    // }
}
