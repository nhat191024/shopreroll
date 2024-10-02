<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\GameAccountController;
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

    Route::prefix('/game-account')->group(function () {
        Route::get('/', [GameAccountController::class, 'index'])->name('admin.gameAccount.index');
        Route::get('/add', [GameAccountController::class, 'showAddGameAccount'])->name('admin.gameAccount.show_add');
        Route::post('/add', [GameAccountController::class, 'addGameAccount'])->name('admin.gameAccount.add');
        Route::post('/edit', [GameAccountController::class, 'editGameAccount'])->name('admin.gameAccount.edit');
        Route::get('/detail/{id}', [GameAccountController::class, 'showDetailGameAccount'])->name('admin.gameAccount.show_detail');
        Route::get('/edit/{id}', [GameAccountController::class, 'showEditGameAccount'])->name('admin.gameAccount.show_edit');
        Route::get('/delete/{id}', [GameAccountController::class, 'deleteGameAccount'])->name('admin.gameAccount.delete');
    });
});
