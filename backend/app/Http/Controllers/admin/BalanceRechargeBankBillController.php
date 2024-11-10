<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceRechargeBankBill;
use App\Service\admin\BalanceRechargeBankBillService;
use Illuminate\Http\Request;

class BalanceRechargeBankBillController extends Controller
{
    private $balanceRechargeBankBillService;

    public function __construct()
    {
        $this->balanceRechargeBankBillService = app(BalanceRechargeBankBillService::class);
    }

    public function index()
    {
        $allBalanceRechargeBankBill = $this->balanceRechargeBankBillService->getAll();
        return view('admin.BalanceRechargeBankBill.BalanceRechargeBankBill', compact('allBalanceRechargeBankBill'));
    }
}
