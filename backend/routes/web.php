<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\RerollCategoryController;
use App\Http\Controllers\admin\RerollSubCategoryController;
use App\Http\Controllers\admin\UserController;
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
    Route::prefix('/reroll-sub-category')->group(function () {
        Route::get('/', [RerollSubCategoryController::class, 'index'])->name('admin.reroll_sub_category.index');
        Route::get('/add', [RerollSubCategoryController::class, 'showAddRerollSubCategory'])->name('admin.reroll_sub_category.show_add');
        Route::post('/add', [RerollSubCategoryController::class, 'addRerollSubCategory'])->name('admin.reroll_sub_category.add');
        Route::post('/edit', [RerollSubCategoryController::class, 'editRerollSubCategory'])->name('admin.reroll_sub_category.edit');
        Route::get('/edit/{id}', [RerollSubCategoryController::class, 'showEditRerollSubCategory'])->name('admin.reroll_sub_category.show_edit');
        Route::get('/delete/{id}', [RerollSubCategoryController::class, 'deleteRerollSubCategory'])->name('admin.reroll_sub_category.delete');
    });
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/add', [UserController::class, 'showAddForm'])->name('admin.user.show');
        Route::post('/add', [UserController::class, 'addUser'])->name('admin.user.add');
        Route::post('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::get('/{id}', [UserController::class, 'show'])->name('admin.user.editView');
    });
});
