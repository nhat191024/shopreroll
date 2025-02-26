<?php

namespace App\Service\admin;

use App\Models\RechargeBill;
use App\Models\User;

class RechargeBillService
{
    public function getAll()
    {
        $rechargeBill = RechargeBill::all();
        return $rechargeBill;
    }

    public function getById($id)
    {
        return RechargeBill::where('id', $id)->first();
    }

    public function checkHasChildren($id)
    {
        return User::find($id)->Buyer()->get()->count() > 0;
    }
}
