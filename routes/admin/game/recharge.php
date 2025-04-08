<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameRechargeController;

Route::prefix('/game-recharge')->name('gameRecharge.')->group(function () {
    Route::get('/', [GameRechargeController::class, 'index'])->name('index');
    Route::get('/create', [GameRechargeController::class, 'create'])->name('create');
    Route::post('/store', [GameRechargeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GameRechargeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GameRechargeController::class, 'update'])->name('update');
    Route::get('/changeStatus/{id}/{status}', [GameRechargeController::class, 'changeStatus'])->name('changeStatus');
});
