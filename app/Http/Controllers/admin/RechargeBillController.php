<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RechargeBill;

class RechargeBillController extends Controller
{
    public function index()
    {
        $allRechargeBill = RechargeBill::all();
        return view('admin.RechargeBill.RechargeBill', compact('allRechargeBill'));
    }

    public function indexC()
    {
        $allRechargeBill =  RechargeBill::all();
        return view('client.layouts.myAcc', compact('allRechargeBill'));
    }
}
