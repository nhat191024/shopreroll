<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GameController;
use App\Http\Controllers\admin\GameCategoryController;
use App\Http\Controllers\admin\GameRechargeController;
use App\Http\Controllers\admin\RechargePackageController;
use App\Http\Controllers\admin\RerollCategoryController;
use App\Http\Controllers\admin\RerollSubCategoryController;
use App\Http\Controllers\admin\RerollPackageController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('/game')->group(function () {
        Route::get('/', [GameController::class, 'index'])->name('admin.game.index');
        Route::get('/add', [GameController::class, 'showAddGame'])->name('admin.game.show_add');
        Route::post('/add', [GameController::class, 'addGame'])->name('admin.game.add');
        Route::post('/edit', [GameController::class, 'editGame'])->name('admin.game.edit');
        Route::get('/edit/{id}', [GameController::class, 'showEditGame'])->name('admin.game.show_edit');
        Route::get('/delete/{id}', [GameController::class, 'ChangeGameStatus'])->name('admin.game.ChangeGameStatus');
    });

    Route::prefix('/game-category')->group(function () {
        Route::get('/', [GameCategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/add', [GameCategoryController::class, 'showAddCategory'])->name('admin.category.show_add');
        Route::post('/add', [GameCategoryController::class, 'addCategory'])->name('admin.category.add');
        Route::post('/edit', [GameCategoryController::class, 'editCategory'])->name('admin.category.edit');
        Route::get('/edit/{id}', [GameCategoryController::class, 'showEditCategory'])->name('admin.category.show_edit');
        Route::get('/delete/{id}', [GameCategoryController::class, 'deleteCategory'])->name('admin.category.delete');
    });

    Route::prefix('/game-recharge')->group(function () {
        Route::get('/', [GameRechargeController::class, 'index'])->name('admin.recharge.index');
        Route::get('/add', [GameRechargeController::class, 'showAddRecharge'])->name('admin.recharge.show_add');
        Route::post('/add', [GameRechargeController::class, 'addRecharge'])->name('admin.recharge.add');
        Route::post('/edit', [GameRechargeController::class, 'editRecharge'])->name('admin.recharge.edit');
        Route::get('/edit/{id}', [GameRechargeController::class, 'showEditRecharge'])->name('admin.recharge.show_edit');
        Route::get('/delete/{id}', [GameRechargeController::class, 'ChangeGameStatus'])->name('admin.recharge.delete');
    });

    Route::prefix('/recharge-package')->group(function () {
        Route::get('/', [RechargePackageController::class, 'index'])->name('admin.package.index');
        Route::get('/add', [RechargePackageController::class, 'showAddRechargePackage'])->name('admin.package.show_add');
        Route::post('/add', [RechargePackageController::class, 'addRechargePackage'])->name('admin.package.add');
        Route::post('/edit', [RechargePackageController::class, 'editRechargePackage'])->name('admin.package.edit');
        Route::get('/edit/{id}', [RechargePackageController::class, 'showEditRechargePackage'])->name('admin.package.show_edit');
        Route::get('/delete/{id}', [RechargePackageController::class, 'deleteRechargePackage'])->name('admin.package.delete');
    });

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
    });

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/add', [UserController::class, 'showAddForm'])->name('admin.user.show');
        Route::post('/add', [UserController::class, 'addUser'])->name('admin.user.add');
        Route::post('/edit/{id}', [UserController::class, 'editUser'])->name('admin.user.edit');
        Route::get('/{id}', [UserController::class, 'showUser'])->name(name: 'admin.user.editView');
        Route::get('/disable/{id}', [UserController::class, 'disableUser'])->name('admin.user.disable');
        Route::get('/store/{id}', [UserController::class, 'storeUser'])->name('admin.user.store');
    });
});
