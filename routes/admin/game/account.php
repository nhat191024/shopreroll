<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameAccountController;

Route::prefix('/game-account')->name('game_account.')->group(function () {
    Route::get('/{game}', [GameAccountController::class, 'index'])->name('index');
    Route::get('/create/{game}', [GameAccountController::class, 'create'])->name('create');
    Route::post('/store/{game}', [GameAccountController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GameAccountController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GameAccountController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [GameAccountController::class, 'destroy'])->name('destroy');
});
