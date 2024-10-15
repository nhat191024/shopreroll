<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\admin\DashboardService;

class DashboardController extends Controller
{

    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function index()
    {
        $day = $this->dashboardService->getRevenueByDay();
        $week = $this->dashboardService->getRevenueByWeek();
        $month = $this->dashboardService->getRevenueByMonth();
        //  dd($month);
        $year = $this->dashboardService->getRevenueByYear();
        $data = $this->dashboardService->getTotalRevenueForYear();
        return view('admin.dashboard.home', compact('day', 'week','month','year','data'));

        // return view('admin.dashboard.home')->with('data',$this->dashboardService->getDashboard());
    }
}
