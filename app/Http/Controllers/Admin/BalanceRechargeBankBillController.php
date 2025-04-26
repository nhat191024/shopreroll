<?php

namespace App\Http\Controllers\Admin;

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
