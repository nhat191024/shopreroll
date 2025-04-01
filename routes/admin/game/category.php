<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameCategoryController;

Route::prefix('/game-category')->name('gameCategory.')->group(function () {
    Route::get('/{id}', [GameCategoryController::class, 'index'])->name('index');
    Route::get('/create/form', [GameCategoryController::class, 'create'])->name('create');
    Route::post('/store', [GameCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GameCategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GameCategoryController::class, 'update'])->name('update');
    Route::get('/destroy/{id}/{status}', [GameCategoryController::class, 'destroy'])->name('destroy');
});
