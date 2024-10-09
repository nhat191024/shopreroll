<?php

namespace App\Service\admin;

use Carbon\Carbon;
use App\Models\AccountBill;
use App\Models\RechargeBill;
use App\Models\RerollBill;

class DashboardService
{

    public function getAll()
    {
        $accountBill =  AccountBill::orderByDesc('created_at')->get();
        $rechargeBill =  RechargeBill::orderByDesc('created_at')->get();
        $rerollBill =  RerollBill::orderByDesc('created_at')->get();
        return [
            'accountBill' => $accountBill,
            'rechargeBill' => $rechargeBill,
            'rerollBill' => $rerollBill,
        ];
    }
    // public function getDashboard()
    // {
    //     $day = $this->getRevenueByDay();
    //     $week = $this->getRevenueByWeek();
    //     $month = $this->getRevenueByMonth();
    //     $years = $this->getRevenueByYear();
    //     return [
    //         'billDay' => $day,
    //         'billWeek' => $week,
    //         'billMonth' => $month,
    //         'billYears' => $years
    //     ];
    // }

    public function getRevenueByDay()
    {
        $totalAccountBill = AccountBill::whereDate('created_at', now()->toDateString())
            ->where('status', 1)
            ->sum('price');
        $totalRechargeBill = RechargeBill::join('recharge_packages', 'recharge_bills.recharge_package_id', '=', 'recharge_packages.id')
            ->whereDate('recharge_bills.created_at', now()->toDateString())
            ->where('recharge_bills.status', 1)
            ->sum('recharge_packages.price');

        $totalRerollBill = RerollBill::whereDate('created_at', now()->toDateString())
            ->where('status', 1)
            ->sum('price');

        $totalBillDay = $totalAccountBill + $totalRerollBill + $totalRechargeBill;
        $percentAccountDay = $totalAccountBill > 0 ? round(($totalBillDay / $totalBillDay) * 100, 2) : 0;
        $percentRerollDay = $totalRerollBill > 0 ? round(($totalRerollBill / $totalBillDay) * 100, 2) : 0;
        $percentRechargeDay = $totalRechargeBill > 0 ? round(($totalRechargeBill / $totalBillDay) * 100, 2) : 0;

        // return number_format($totalBillDay, $percentAccountDay, $percentRerollDay, $percentRechargeDay);
        return [
            'totalBillDay' => $totalBillDay,
            'percentAccountDay' => $percentAccountDay,
            'percentRerollDay' => $percentRerollDay,
            'percentRechargeDay' => $percentRechargeDay
        ];
    }


    public function getRevenueByWeek()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $totalAccountBill = AccountBill::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', 1)
            ->sum('price');

        $totalRechargeBill = RechargeBill::join('recharge_packages', 'recharge_bills.recharge_package_id', '=', 'recharge_packages.id')
            ->whereBetween('recharge_bills.created_at', [$startOfWeek, $endOfWeek])
            ->where('recharge_bills.status', 1)
            ->sum('recharge_packages.price');

        $totalRerollBill = RerollBill::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', 1)
            ->sum('price');

        $totalBillWeek = $totalAccountBill + $totalRerollBill + $totalRechargeBill;
        $percentAccountWeek = $totalAccountBill > 0 ? round(($totalAccountBill / $totalBillWeek) * 100, 2) : 0;
        $percentRerollWeek = $totalRerollBill > 0 ? round(($totalRerollBill / $totalBillWeek) * 100, 2) : 0;
        $percentRechargeWeek = $totalRechargeBill > 0 ? round(($totalRechargeBill / $totalBillWeek) * 100, 2) : 0;

        // return number_format($totalBillWeek, $percentAccountWeek, $percentRerollWeek, $percentRechargeWeek);
        return [
            'totalBillWeek' => $totalBillWeek,
            'percentAccountWeek' => $percentAccountWeek,
            'percentRerollWeek' => $percentRerollWeek,
            'percentRechargeWeek' => $percentRechargeWeek
        ];
    }


    public function getRevenueByMonth()
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $totalAccountBill = AccountBill::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('status', 1)
            ->sum('price');

        $totalRechargeBill = RechargeBill::join('recharge_packages', 'recharge_bills.recharge_package_id', '=', 'recharge_packages.id')
            ->whereBetween('recharge_bills.created_at', [$startOfMonth, $endOfMonth])
            ->where('recharge_bills.status', 1)
            ->sum('recharge_packages.price');

        $totalRerollBill = RerollBill::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('status', 1)
            ->sum('price');

        $totalBillMonth = $totalAccountBill + $totalRerollBill + $totalRechargeBill;
        $percentAccountMonth = $totalAccountBill > 0 ? round(($totalAccountBill / $totalBillMonth) * 100, 2) : 0;
        $percentRerollMonth = $totalRerollBill > 0 ? round(($totalRerollBill / $totalBillMonth) * 100, 2) : 0;
        $percentRechargeMonth = $totalRechargeBill > 0 ? round(($totalRechargeBill / $totalBillMonth) * 100, 2) : 0;
        
        // return number_format($totalBillMonth,$percentAccountMonth,$percentRechargeMonth,$percentRerollMonth);
        return [
            'totalBillMonth' => $totalBillMonth,
            'percentAccountMonth' => $percentAccountMonth,
            'percentRerollMonth' => $percentRerollMonth,
            'percentRechargeMonth' => $percentRechargeMonth
        ];
    }
    public function getTotalRevenueForYear()
    {
        $revenueByMonth = [];
    
        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = now()->setMonth($month)->startOfMonth();
            $endOfMonth = now()->setMonth($month)->endOfMonth();
    
            $totalAccountBill = AccountBill::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', 1)
                ->sum('price');
    
            $totalRechargeBill = RechargeBill::join('recharge_packages', 'recharge_bills.recharge_package_id', '=', 'recharge_packages.id')
                ->whereBetween('recharge_bills.created_at', [$startOfMonth, $endOfMonth])
                ->where('recharge_bills.status', 1)
                ->sum('recharge_packages.price');
    
            $totalRerollBill = RerollBill::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status', 1)
                ->sum('price');
    
            // Tổng tiền cho tháng này
            $totalBillMonth = $totalAccountBill + $totalRerollBill + $totalRechargeBill;
    
            $revenueByMonth[] = [
                'month' => $month,
                'totalRevenue' => $totalBillMonth
            ];
        }
    
        return $revenueByMonth;
    }
    
    public function getRevenueByYear()
    {
        $startOfYear = now()->startOfYear();
        $endOfYear = now()->endOfYear();

        $totalAccountBill = AccountBill::whereBetween('created_at', [$startOfYear, $endOfYear])
            ->where('status', 1)
            ->sum('price');

        $totalRechargeBill = RechargeBill::join('recharge_packages', 'recharge_bills.recharge_package_id', '=', 'recharge_packages.id')
            ->whereBetween('recharge_bills.created_at', [$startOfYear, $endOfYear])
            ->where('recharge_bills.status', 1)
            ->sum('recharge_packages.price');

        $totalRerollBill = RerollBill::whereBetween('created_at', [$startOfYear, $endOfYear])
            ->where('status', 1)
            ->sum('price');

        $totalBillYear = $totalAccountBill + $totalRerollBill + $totalRechargeBill;
        $percentAccount = $totalAccountBill > 0 ? round(($totalAccountBill / $totalBillYear) * 100, 2) : 0;
        $percentReroll = $totalRerollBill > 0 ? round(($totalRerollBill / $totalBillYear) * 100, 2) : 0;
        $percentRecharge = $totalRechargeBill > 0 ? round(($totalRechargeBill / $totalBillYear) * 100, 2) : 0;
        return [
            'totalBillYear' => $totalBillYear,
            'percentAccount' => $percentAccount,
            'percentReroll' => $percentReroll,
            'percentRecharge' => $percentRecharge
        ];
    }
}
