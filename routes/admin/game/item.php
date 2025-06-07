<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameItemController;

Route::prefix('/game_item')->name('game_item.')->group(function () {
    Route::get('/{game_id}', [GameItemController::class, 'index'])->name('index');
    Route::get('/create/{game_id}', [GameItemController::class, 'create'])->name('create');
    Route::post('/store', [GameItemController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GameItemController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GameItemController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [GameItemController::class, 'destroy'])->name('destroy');
});
