<?php

use App\Http\Controllers\admin\ApiController;
use App\Http\Controllers\admin\BalanceRechargeBankBillController;
use App\Http\Controllers\admin\BalanceRechargeCardBillController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RechargeBillController;
use App\Http\Controllers\admin\RerollBillController;
use App\Http\Controllers\client\AccountBillController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\MyKeyController;
use App\Http\Controllers\client\RechargeShopController;

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

// shop routes
Route::get('/reroll/detail/{id}', [HomeController::class, 'rerollDetail'])->name('client.reroll.detail');
Route::post('/reroll/detail/buy', [HomeController::class, 'buyRerollDetail'])->name('client.reroll.detail.buy');
Route::get('/reroll/detail/{id}/tutorial', [HomeController::class, 'rerollTutorial'])->name('client.reroll.detail.tutorial');

// Note: route 0=userClient, 1=admin, 2=collaborator
// role:0,1,2 means all userClient, admin, collaborator can access this route
Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::middleware(['auth', 'role:0,1,2'])->group(function () {
    Route::get('/myAcc/genshin', [AccountBillController::class, 'genshin'])->name('client.myAccGenshin');
    Route::get('/my-key', [MyKeyController::class, 'index'])->name('client.MyKey.index');
});

// game recharge routes
Route::get('/recharge/{id}', [RechargeShopController::class, 'index'])->name('client.recharge');
Route::post('/recharge/confirm', [RechargeShopController::class, 'rechargeConfirm'])->name('client.recharge.confirm');

Route::get('/my-account', function () {
    return view('client.my-account');
});

// Note: route 0=userClient, 1=admin, 2=collaborator
// role:1,2 means only admin, collaborator can access this route
Route::middleware(['auth', 'role:1,2'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        require __DIR__ . '/admin/game/index.php';
        require __DIR__ . '/admin/game/item_type.php';
        require __DIR__ . '/admin/game/item.php';
        require __DIR__ . '/admin/game/attribute.php';
        require __DIR__ . '/admin/game/category.php';
        require __DIR__ . '/admin/game/recharge.php';
        require __DIR__ . '/admin/game/rechargePackage.php';
        require __DIR__ . '/admin/game/account.php';
        require __DIR__ . '/admin/reroll/category.php';
        require __DIR__ . '/admin/reroll/subCategory.php';
        require __DIR__ . '/admin/reroll/package.php';
        require __DIR__ . '/admin/reroll/key.php';

        Route::get('/recharge-bill', [RechargeBillController::class, 'index'])->name('rechargeBill.index');
        Route::get('/reroll-bill', [RerollBillController::class, 'index'])->name('rerollBill.index');
        Route::get('/bank-bill', [BalanceRechargeBankBillController::class, 'index'])->name('balanceRechargeBankBill.index');
        Route::get('/card-bill', [BalanceRechargeCardBillController::class, 'index'])->name('balanceRechargeCardBill.index');

        require __DIR__ . '/admin/user.php';
    });
});
