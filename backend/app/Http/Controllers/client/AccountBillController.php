<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Service\client\AccountBillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountBillController extends Controller
{
    private $accountBillService;
    public function __construct(AccountBillService $accountBillService)
    {
        $this->accountBillService = $accountBillService;
    }
    public function index()
    {
        $accountBills = $this->accountBillService->getAllByUserId(Auth::id());
        return view('client.layouts.myAcc', compact('accountBills'));
    }
}
