<?php

use App\Http\Controllers\Admin\ApiController;
use App\Http\Controllers\admin\BalanceRechargeBankBillController;
use App\Http\Controllers\admin\BalanceRechargeCardBillController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GameController;
use App\Http\Controllers\admin\GameCategoryController;
use App\Http\Controllers\admin\GameRechargeController;
use App\Http\Controllers\admin\GameRechargePackageController;
use App\Http\Controllers\admin\RechargeBillController;
use App\Http\Controllers\admin\RerollCategoryController;
use App\Http\Controllers\admin\RerollSubCategoryController;
use App\Http\Controllers\admin\RerollPackageController;
use App\Http\Controllers\admin\RerollBillController;
use App\Http\Controllers\admin\RerollKeyController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\GameAccountController;
use App\Models\RechargeBill;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/myAcc',[RechargeBillController::class,'indexC'])->name('client.myAcc');
});
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/bank-bill', [BalanceRechargeBankBillController::class, 'index'])->name('admin.BalanceRechargeBankBill.index');
    Route::get('/card-bill', [BalanceRechargeCardBillController::class, 'index'])->name('admin.BalanceRechargeCardBill.index');

    Route::prefix('/game')->group(function () {
        Route::get('/', [GameController::class, 'index'])->name('admin.game.index');
        Route::get('/add', [GameController::class, 'showAddGame'])->name('admin.game.show_add');
        Route::post('/add', [GameController::class, 'addGame'])->name('admin.game.add');
        Route::post('/edit', [GameController::class, 'editGame'])->name('admin.game.edit');
        Route::get('/edit/{id}', [GameController::class, 'showEditGame'])->name('admin.game.show_edit');
        Route::get('/ChangeStatus/{id}/{status}', [GameController::class, 'ChangeGameStatus'])->name('admin.game.ChangeStatus');
    });
    Route::get('characters/{slug}', [ApiController::class, 'indexGameCharacters'])->name('admin.character');
    Route::get('weapons/{slug}', [ApiController::class, 'indexGameWeapons'])->name('admin.weapon');
    Route::get('/syncCharacters', [ApiController::class, 'syncHeroData'])->name('syncCharacters');
    Route::get('/syncWeapons', [ApiController::class, 'syncWeaponData'])->name('syncWeapons');

    Route::prefix('/game-category')->group(function () {
        Route::get('/list/{id}', [GameCategoryController::class, 'index'])->name('admin.GameCategory.index');
        Route::get('/add', [GameCategoryController::class, 'showAddCategory'])->name('admin.GameCategory.showAdd');
        Route::post('/add', [GameCategoryController::class, 'addCategory'])->name('admin.GameCategory.add');
        Route::post('/edit', [GameCategoryController::class, 'editCategory'])->name('admin.GameCategory.edit');
        Route::get('/edit/{id}', [GameCategoryController::class, 'showEditCategory'])->name('admin.GameCategory.showEdit');
        Route::get('/ChangeStatus/{id}/{status}', [GameCategoryController::class, 'ChangeGameCategoryStatus'])->name('admin.GameCategory.ChangeStatus');
    });

    Route::prefix('/game-recharge')->group(function () {
        Route::get('/', [GameRechargeController::class, 'index'])->name('admin.GameRecharge.index');
        Route::get('/add', [GameRechargeController::class, 'showAddRecharge'])->name('admin.GameRecharge.showAdd');
        Route::post('/add', [GameRechargeController::class, 'addRecharge'])->name('admin.GameRecharge.add');
        Route::post('/edit', [GameRechargeController::class, 'editRecharge'])->name('admin.GameRecharge.edit');
        Route::get('/edit/{id}', [GameRechargeController::class, 'showEditRecharge'])->name('admin.GameRecharge.showEdit');
        Route::get('/ChangeStatus/{id}/{status}', [GameRechargeController::class, 'ChangeGameStatus'])->name('admin.GameRecharge.ChangeGameRechargeStatus');
    });

    Route::prefix('/game-recharge-package')->group(function () {
        Route::get('/list/{id}', [GameRechargePackageController::class, 'index'])->name('admin.GameRechargePackage.index');
        Route::get('/add', [GameRechargePackageController::class, 'showAddGameRechargePackage'])->name('admin.GameRechargePackage.showAdd');
        Route::post('/add', [GameRechargePackageController::class, 'addRechargePackage'])->name('admin.GameRechargePackage.add');
        Route::post('/edit', [GameRechargePackageController::class, 'editRechargePackage'])->name('admin.GameRechargePackage.edit');
        Route::get('/edit/{id}', [GameRechargePackageController::class, 'showEditRechargePackage'])->name('admin.GameRechargePackage.showEdit');
        Route::get('/ChangeStatus/{id}/{status}', [GameRechargePackageController::class, 'ChangeGameRechargePackageStatus'])->name('admin.GameRechargePackage.ChangeGameRechargePackageStatus');
    });

    Route::get('/recharge-bill', [RechargeBillController::class, 'index'])->name('admin.RechargeBill.index');

    Route::prefix('/reroll-category')->group(function () {
        Route::get('/', [RerollCategoryController::class, 'index'])->name('admin.RerollCategory.index');
        Route::get('/add', [RerollCategoryController::class, 'showAddRerollCategory'])->name('admin.RerollCategory.showAdd');
        Route::post('/add', [RerollCategoryController::class, 'addRerollCategory'])->name('admin.RerollCategory.add');
        Route::post('/edit', [RerollCategoryController::class, 'editRerollCategory'])->name('admin.RerollCategory.edit');
        Route::get('/edit/{id}', [RerollCategoryController::class, 'showEditRerollCategory'])->name('admin.RerollCategory.ShowEdit');
        Route::get('/detail/{id}', [RerollCategoryController::class, 'detailRerollCategory'])->name('admin.RerollCategory.Detail');
        Route::get('/ChangeStatus/{id}', [RerollCategoryController::class, 'ChangeCategoryStatus'])->name('admin.RerollCategory.ChangeStatus');
    });

    Route::prefix('/reroll-sub-category')->group(function () {
        Route::get('/', [RerollSubCategoryController::class, 'index'])->name('admin.rerollSubCategory.index');
        Route::get('/add', [RerollSubCategoryController::class, 'showAddRerollSubCategory'])->name('admin.rerollSubCategory.showAdd');
        Route::post('/add', [RerollSubCategoryController::class, 'addRerollSubCategory'])->name('admin.rerollSubCategory.add');
        Route::post('/edit', [RerollSubCategoryController::class, 'editRerollSubCategory'])->name('admin.rerollSubCategory.edit');
        Route::get('/edit/{id}', [RerollSubCategoryController::class, 'showEditRerollSubCategory'])->name('admin.RerollSubCategory.ShowEdit');
        Route::get('/detail/{id}', [RerollSubCategoryController::class, 'detailRerollSubCategory'])->name('admin.RerollSubCategory.Detail');
        Route::get('/ChangeStatus/{id}', [RerollSubCategoryController::class, 'ChangeCategoryStatus'])->name('admin.RerollSubCategory.ChangeStatus');
    });

    Route::prefix('/reroll-package')->group(function () {
        Route::get('/', [RerollPackageController::class, 'index'])->name('admin.RerollPackage.index');
        Route::get('/add', [RerollPackageController::class, 'showAddRerollPackage'])->name('admin.RerollPackage.showAdd');
        Route::post('/add', [RerollPackageController::class, 'addRerollPackage'])->name('admin.RerollPackage.add');
        Route::post('/edit', [RerollPackageController::class, 'editRerollPackage'])->name('admin.RerollPackage.edit');

        Route::get('/edit/{id}', [RerollPackageController::class, 'showEditRerollPackage'])->name('admin.RerollPackage.showEdit');
        Route::get('/delete/{id}', [RerollPackageController::class, 'deleteRerollPackage'])->name('admin.RerollPackage.delete');
        Route::get('/detail/{id}', [RerollPackageController::class, 'detailRerollPackage'])->name('admin.RerollPackage.detail');
        Route::prefix('/detail/{idPackage}/reroll-key')->group(function () {
            Route::get('/', [RerollKeyController::class, 'index'])->name('admin.RerollKey.index');
            Route::get('/add', [RerollKeyController::class, 'showAddRerollKey'])->name('admin.rerollKey.showAdd');
            Route::post('/add', [RerollKeyController::class, 'addRerollKey'])->name('admin.rerollKey.add');
            Route::post('/edit', [RerollKeyController::class, 'editRerollKey'])->name('admin.rerollKey.edit');
            Route::get('/edit/{idKey}', [RerollKeyController::class, 'showEditRerollKey'])->name('admin.RerollKey.ShowEdit');
            Route::get('/delete/{idKey}', [RerollKeyController::class, 'deleteRerollPackage'])->name('admin.RerollKey.delete');
        });
    });

    Route::get('/reroll-bill', [RerollBillController::class, 'index'])->name('admin.RerollBill.index');

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/add', [UserController::class, 'showAddForm'])->name('admin.user.show');
        Route::post('/add', [UserController::class, 'addUser'])->name('admin.user.add');
        Route::post('/edit/{id}', [UserController::class, 'editUser'])->name('admin.user.edit');
        Route::get('/{id}', [UserController::class, 'showUser'])->name(name: 'admin.user.editView');
        Route::get('/disable/{id}', [UserController::class, 'disableUser'])->name('admin.user.disable');
        Route::get('/store/{id}', [UserController::class, 'storeUser'])->name('admin.user.store');
    });
    Route::get('characters/{slug}', [ApiController::class, 'indexGameCharacters'])->name('admin.character');
    Route::get('weapons/{slug}', [ApiController::class, 'indexGameWeapons'])->name('admin.weapon');

    Route::prefix('/game-account')->group(function () {
        Route::get('/', [GameAccountController::class, 'index'])->name('admin.gameAccount.index');
        Route::get('/add', [GameAccountController::class, 'showAddForm'])->name('admin.gameAccount.showAddForm');
        Route::post('/add', [GameAccountController::class, 'addGameAccount'])->name('admin.gameAccount.add');
        Route::post('/edit/{id}', [GameAccountController::class, 'editGameAccount'])->name('admin.gameAccount.edit');
        Route::get('/edit/{id}', [GameAccountController::class, 'showEditForm'])->name('admin.gameAccount.showEditForm');
        Route::get('/disable/{id}', [GameAccountController::class, 'disableGameAccount'])->name('admin.gameAccount.disable');
        Route::get('/store/{id}', [GameAccountController::class, 'storeGameAccount'])->name('admin.gameAccount.store');
        Route::get('/get-game-details/{categoryId}', [GameAccountController::class, 'getGameDetails'])->name('admin.gameAccount.getGameDetails');
        Route::post('/game-account/import', [GameAccountController::class, 'importFromExcel'])->name('admin.gameAccount.import');
    });
});
