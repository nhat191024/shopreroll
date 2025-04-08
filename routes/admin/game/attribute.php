<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameAttributeController;

Route::prefix('/game_attribute')->name('game_attribute.')->group(function () {
    Route::get('/{game_id}', [GameAttributeController::class, 'index'])->name('index');
    Route::get('/create/{game_id}', [GameAttributeController::class, 'create'])->name('create');
    Route::post('/store', [GameAttributeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GameAttributeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GameAttributeController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [GameAttributeController::class, 'destroy'])->name('destroy');
});
