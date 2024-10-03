<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\GameController;
use App\Models\GameCategory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {

    Route::prefix('/category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/add', [CategoryController::class, 'showAddCategory'])->name('admin.category.show_add');
        Route::post('/add', [CategoryController::class, 'addCategory'])->name('admin.category.add');
        Route::post('/edit', [CategoryController::class, 'editCategory'])->name('admin.category.edit');
        Route::get('/edit/{id}', [CategoryController::class, 'showEditCategory'])->name('admin.category.show_edit');
        Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');
    });

    Route::prefix('/game')->group(function () {
        Route::get('/', [GameController::class, 'index'])->name('admin.game.index');
        Route::get('/add', [GameController::class, 'showAddGame'])->name('admin.game.show_add');
        Route::post('/add', [GameController::class, 'addGame'])->name('admin.game.add');
        Route::post('/edit', [GameController::class, 'editGame'])->name('admin.game.edit');
        Route::get('/edit/{id}', [GameController::class, 'showEditGame'])->name('admin.game.show_edit');
        Route::get('/delete/{id}', [GameController::class, 'deleteGame'])->name('admin.game.delete');
    });
});
