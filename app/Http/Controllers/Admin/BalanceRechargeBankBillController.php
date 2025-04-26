<?php

namespace App\Http\Controllers\admin;

use App\Models\BalanceRechargeBankBill;

use App\Http\Controllers\Controller;

class BalanceRechargeBankBillController extends Controller
{
    public function index()
    {
        $allBalanceRechargeBankBill  = BalanceRechargeBankBill::all()->load('User');
        return view('admin.BalanceRechargeBankBill.BalanceRechargeBankBill', compact('allBalanceRechargeBankBill'));
    }
}
