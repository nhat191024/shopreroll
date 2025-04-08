<?php

namespace App\Http\Controllers\admin;

use App\Models\BalanceRechargeCardBill;

use App\Http\Controllers\Controller;

class BalanceRechargeCardBillController extends Controller
{
    public function index()
    {
        $allBalanceRechargeCardBill = BalanceRechargeCardBill::all()->load('User');
        return view('admin.BalanceRechargeCardBill.BalanceRechargeCardBill', compact('allBalanceRechargeCardBill'));
    }
}
