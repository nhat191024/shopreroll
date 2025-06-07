<?php

use App\Http\Controllers\Admin\ApiController;
use App\Http\Controllers\Admin\BalanceRechargeBankBillController;
use App\Http\Controllers\Admin\BalanceRechargeCardBillController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RechargeBillController;
use App\Http\Controllers\Admin\RerollBillController;
use App\Http\Controllers\client\AccountBillController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\MyKeyController;
use App\Http\Controllers\client\RechargeShopController;
use App\Http\Controllers\client\UserAccountController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

// shop routes
Route::get('/reroll/detail/{id}', [HomeController::class, 'rerollDetail'])->name('client.reroll.detail');
Route::post('/reroll/detail/buy', [HomeController::class, 'buyRerollDetail'])->name('client.reroll.detail.buy');
Route::get('/reroll/detail/{id}/tutorial', [HomeController::class, 'rerollTutorial'])->name('client.reroll.detail.tutorial');
Route::get('/game/account/{gameId}/category/{categoryId}', [HomeController::class, 'gameAccountList'])->name('client.game.account.category');
Route::get('/game/account/detail/{accountId}', [HomeController::class, 'accountDetail'])->name('client.game.account.detail');
// buy now
Route::get('/game/account/buy-now/{id}', [AccountBillController::class, 'buyGameAccount'])->name('client.account-shop.buy-now');
Route::get('/user/forgot', [UserAccountController::class, 'forgotPassword'])->name('client.user.forgot');
Route::get('/user/reset', [UserAccountController::class, 'resetPassword'])->name('client.user.reset');
Route::post('/user/reset/confirm', [UserAccountController::class, 'confirmResetPassword'])->name('client.user.reset.confirm');
Route::post('/user/forgot/confirm', [UserAccountController::class, 'confirmForgotPassword'])->name('client.user.forgot.confirm');


// Note: route 0=userClient, 1=admin, 2=collaborator
// role:0,1,2 means all userClient, admin, collaborator can access this route
Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::middleware(['auth', 'role:'. User::CLIENT . User::ADMIN . User::COLLABORATOR])->group(function () {
    Route::get('/myAcc/genshin', [AccountBillController::class, 'genshin'])->name('client.myAccGenshin');
    Route::get('/myAcc/balance-history', [AccountBillController::class, 'balanceHistory'])->name('client.user.balance-history');
    Route::get('/myAcc/all', [AccountBillController::class, 'allAccount'])->name('client.account.all');
    Route::get('/my-key', [MyKeyController::class, 'index'])->name('client.myKey.index');
    Route::get('/user/change', [UserAccountController::class, 'changePassword'])->name('client.user.change');
    Route::post('/user/change/confirm', [UserAccountController::class, 'confirmChangePassword'])->name('client.user.change.confirm');
    Route::get('/user/topup/bank', [UserAccountController::class, 'topupByBank'])->name('client.user.topup.bank');
    Route::get('/user/topup/card', [UserAccountController::class, 'topupByCard'])->name('client.user.topup.card');
    Route::post('/user/topup/card/submit', [UserAccountController::class, 'submitTopupByCard'])->name('client.user.topup.card.submit');
});

// game recharge routes
Route::get('/recharge/{id}', [RechargeShopController::class, 'index'])->name('client.recharge');
Route::post('/recharge/confirm', [RechargeShopController::class, 'rechargeConfirm'])->name('client.recharge.confirm');

Route::get('/my-account', function () {
    return view('client.my-account');
});

// Note: route 0=userClient, 1=admin, 2=collaborator
// role:1,2 means only admin, collaborator can access this route
Route::middleware(['auth', 'role:'. User::ADMIN ])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        require __DIR__ . '/admin/game/index.php';
        require __DIR__ . '/admin/game/item_type.php';
        require __DIR__ . '/admin/game/item.php';
        require __DIR__ . '/admin/game/attribute.php';
        require __DIR__ . '/admin/game/category.php';
        require __DIR__ . '/admin/game/recharge.php';
        require __DIR__ . '/admin/game/rechargePackage.php';
        require __DIR__ . '/admin/reroll/category.php';
        require __DIR__ . '/admin/reroll/subCategory.php';
        require __DIR__ . '/admin/reroll/package.php';
        require __DIR__ . '/admin/reroll/key.php';
        require __DIR__ . '/admin/settings.php';

        Route::get('/recharge-bill', [RechargeBillController::class, 'index'])->name('rechargeBill.index');
        Route::get('/recharge-bill/change-status/{id}/{status}', [RechargeBillController::class, 'changeStatus'])->name('rechargeBill.changeStatus');
        Route::get('/reroll-bill', [RerollBillController::class, 'index'])->name('rerollBill.index');
        Route::get('/bank-bill', [BalanceRechargeBankBillController::class, 'index'])->name('balanceRechargeBankBill.index');
        Route::get('/card-bill', [BalanceRechargeCardBillController::class, 'index'])->name('balanceRechargeCardBill.index');

        require __DIR__ . '/admin/user.php';
    });
});

Route::middleware(['auth', 'role:'. User::ADMIN . User::COLLABORATOR ])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        require __DIR__ . '/admin/game/account.php';
    });
});
