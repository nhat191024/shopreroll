<?php

namespace App\Http\Controllers\Admin;

use App\Models\RerollBill;

use App\Http\Controllers\Controller;

class RerollBillController extends Controller
{
    public function index()
    {
        $rerollBills = RerollBill::all()->load('Buyer', 'RerollPackage', 'RerollKey');
        return view('admin.rerollBill.index', compact('rerollBills'));
    }
}
