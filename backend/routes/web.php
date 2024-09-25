<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\RerollCategoryController;
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
    Route::prefix('/reroll-category')->group(function () {
        Route::get('/', [RerollCategoryController::class, 'index'])->name('admin.reroll_category.index');
        Route::get('/add', [RerollCategoryController::class, 'showAddRerollCategory'])->name('admin.reroll_category.show_add');
        Route::post('/add', [RerollCategoryController::class, 'addRerollCategory'])->name('admin.reroll_category.add');
        Route::post('/edit', [RerollCategoryController::class, 'editRerollCategory'])->name('admin.reroll_category.edit');
        Route::get('/edit/{id}', [RerollCategoryController::class, 'showEditRerollCategory'])->name('admin.reroll_category.show_edit');
        Route::get('/delete/{id}', [RerollCategoryController::class, 'deleteRerollCategory'])->name('admin.reroll_category.delete');
        
    });
});