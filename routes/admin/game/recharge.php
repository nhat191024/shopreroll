<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameRechargeController;

Route::prefix('/game-recharge')->name('GameRecharge.')->group(function () {
    Route::get('/', [GameRechargeController::class, 'index'])->name('index');
    Route::get('/add', [GameRechargeController::class, 'showAddRecharge'])->name('showAdd');
    Route::post('/add', [GameRechargeController::class, 'addRecharge'])->name('add');
    Route::post('/edit', [GameRechargeController::class, 'editRecharge'])->name('edit');
    Route::get('/edit/{id}', [GameRechargeController::class, 'showEditRecharge'])->name('showEdit');
    Route::get('/ChangeStatus/{id}/{status}', [GameRechargeController::class, 'ChangeGameStatus'])->name('ChangeGameRechargeStatus');
});
