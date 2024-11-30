<?php

namespace App\Service\admin;

use App\Models\BalanceRechargeBankBill;
use App\Models\User;

class BalanceRechargeBankBillService
{
    public function getAll()
    {
        $balanceRechargeBankBill = BalanceRechargeBankBill::all();
        return $balanceRechargeBankBill;
    }

    public function getById($id)
    {
        return BalanceRechargeBankBill::where('id', $id)->first();
    }

    public function checkHasChildren($id)
    {
        return User::find($id)->Buyer()->get()->count() > 0;
    }
}
