<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameRechargePackageController;

Route::prefix('/game-recharge-package')->name('GameRechargePackage.')->group(function () {
    Route::get('/list/{id}', [GameRechargePackageController::class, 'index'])->name('index');
    Route::get('/add', [GameRechargePackageController::class, 'showAddGameRechargePackage'])->name('showAdd');
    Route::post('/add', [GameRechargePackageController::class, 'addRechargePackage'])->name('add');
    Route::post('/edit', [GameRechargePackageController::class, 'editRechargePackage'])->name('edit');
    Route::get('/edit/{id}', [GameRechargePackageController::class, 'showEditRechargePackage'])->name('showEdit');
    Route::get('/ChangeStatus/{id}/{status}', [GameRechargePackageController::class, 'ChangeGameRechargePackageStatus'])->name('ChangeGameRechargePackageStatus');
});
