<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameCategoryController;

Route::prefix('/game-category')->name('GameCategory.')->group(function () {
    Route::get('/{id}', [GameCategoryController::class, 'index'])->name('index');
    Route::get('/add', [GameCategoryController::class, 'showAddCategory'])->name('showAdd');
    Route::post('/add', [GameCategoryController::class, 'addCategory'])->name('add');
    Route::post('/edit', [GameCategoryController::class, 'editCategory'])->name('edit');
    Route::get('/edit/{id}', [GameCategoryController::class, 'showEditCategory'])->name('showEdit');
    Route::get('/ChangeStatus/{id}/{status}', [GameCategoryController::class, 'ChangeGameCategoryStatus'])->name('ChangeStatus');
});
