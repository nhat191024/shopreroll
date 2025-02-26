<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\RerollBillService;
use Illuminate\Http\Request;

class RerollBillController extends Controller
{
    private $rerollBillService;


    public function __construct()
    {
        $this->rerollBillService = app(RerollBillService::class);
    }

    public function index()
    {
        $allRerollBill = $this->rerollBillService->getAll();
        return view('admin.RerollBill.RerollBill', compact('allRerollBill'));
    }
}
