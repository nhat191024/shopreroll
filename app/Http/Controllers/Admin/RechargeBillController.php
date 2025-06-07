<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RechargeBill;

class RechargeBillController extends Controller
{
    public function index()
    {
        $allRechargeBill = RechargeBill::all();
        return view('admin.RechargeBill.RechargeBill', compact('allRechargeBill'));
    }

    public function changeStatus($id, $status)
    {
        $rechargeBill = RechargeBill::find($id);
        if ($rechargeBill) {
            $rechargeBill->status = $status;
            $rechargeBill->save();
            return redirect()->back()->with('success', 'Status updated successfully.');
        }
        return redirect()->back()->with('error', 'Recharge Bill not found.');
    }
}
