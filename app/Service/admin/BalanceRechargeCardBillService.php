<?php

namespace App\Service\admin;

use App\Models\BalanceRechargeCardBill;
use App\Models\User;

class BalanceRechargeCardBillService
{
    public function getAll()
    {
        $balanceRechargeCardBillService = BalanceRechargeCardBill::all();
        return $balanceRechargeCardBillService;
    }

    public function getById($id)
    {
        return BalanceRechargeCardBill::where('id', $id)->first();
    }

    public function checkHasChildren($id)
    {
        return User::find($id)->Buyer()->get()->count() > 0;
    }
}
