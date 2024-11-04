<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\BalanceRechargeCardBillService;
use Illuminate\Http\Request;

class BalanceRechargeCardBillController extends Controller
{
    private $balanceRechargeCardBillService;

    public function __construct()
    {
        $this->balanceRechargeCardBillService = app(BalanceRechargeCardBillService::class);
    }

    public function index()
    {
        $allBalanceRechargeCardBill = $this->balanceRechargeCardBillService->getAll();
        return view('admin.BalanceRechargeCardBill.BalanceRechargeCardBill', compact('allBalanceRechargeCardBill'));
    }
}
