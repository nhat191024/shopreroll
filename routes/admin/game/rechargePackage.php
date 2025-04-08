<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameRechargePackageController;

Route::prefix('/game-recharge-package')->name('gameRechargePackage.')->group(function () {
    Route::get('/{id}', [GameRechargePackageController::class, 'index'])->name('index');
    Route::get('/create/form', [GameRechargePackageController::class, 'create'])->name('create');
    Route::post('/store', [GameRechargePackageController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GameRechargePackageController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GameRechargePackageController::class, 'update'])->name('update');
    Route::get('/destroy/{id}/{status}', [GameRechargePackageController::class, 'destroy'])->name('destroy');
});
