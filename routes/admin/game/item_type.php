<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameItemTypeController;

Route::prefix('/game_item_type')->name('game_item_type.')->group(function () {
    Route::get('/{game_id}', [GameItemTypeController::class, 'index'])->name('index');
    Route::get('/create/{game_id}', [GameItemTypeController::class, 'create'])->name('create');
    Route::post('/store', [GameItemTypeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GameItemTypeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GameItemTypeController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [GameItemTypeController::class, 'destroy'])->name('destroy');
});
