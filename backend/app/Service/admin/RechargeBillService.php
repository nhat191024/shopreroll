<?php

namespace App\Service\admin;

use App\Models\RechargeBill;

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
}
