<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\admin\GameRechargePackageService;
use App\Service\admin\RechargeBillService;
use App\Service\admin\UserService;
use Illuminate\Http\Request;

class RechargeBillController extends Controller
{
    private $rechargeBillService;

    public function __construct()
    {
        $this->rechargeBillService = app(RechargeBillService::class);
    }

    public function index()
    {
        $allRechargeBill = $this->rechargeBillService->getAll();
        return view('admin.RechargeBill.RechargeBill', compact('allRechargeBill'));
    }
}
