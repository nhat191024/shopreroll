<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\RerollCategoryController;
use App\Http\Controllers\admin\RerollSubCategoryController;
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
        Route::get('/', [RerollCategoryController::class, 'index'])->name('admin.RerollCategory.index');
        Route::get('/add', [RerollCategoryController::class, 'showAddRerollCategory'])->name('admin.RerollCategory.showAdd');
        Route::post('/add', [RerollCategoryController::class, 'addRerollCategory'])->name('admin.RerollCategory.add');
        Route::post('/edit', [RerollCategoryController::class, 'editRerollCategory'])->name('admin.RerollCategory.edit');
        Route::get('/edit/{id}', [RerollCategoryController::class, 'showEditRerollCategory'])->name('admin.RerollCategory.ShowEdit');
        Route::get('/detail/{id}', [RerollCategoryController::class, 'detailRerollCategory'])->name('admin.RerollCategory.Detail');
        Route::get('/ChangeStatus/{id}', [RerollCategoryController::class, 'ChangeCategoryStatus'])->name('admin.RerollCategory.ChangeStatus');
    });
    Route::prefix('/reroll-sub-category')->group(function () {
        Route::get('/', [RerollSubCategoryController::class, 'index'])->name('admin.RerollSubCategory.index');
        Route::get('/add', [RerollSubCategoryController::class, 'showAddRerollSubCategory'])->name('admin.reroll_sub_category.show_add');
        Route::post('/add', [RerollSubCategoryController::class, 'addRerollSubCategory'])->name('admin.reroll_sub_category.add');
        Route::post('/edit', [RerollSubCategoryController::class, 'editRerollSubCategory'])->name('admin.reroll_sub_category.edit');
        Route::get('/edit/{id}', [RerollSubCategoryController::class, 'showEditRerollSubCategory'])->name('admin.RerollSubCategory.ShowEdit');
        Route::get('/ChangeStatus/{id}', [RerollSubCategoryController::class, 'ChangeCategoryStatus'])->name('admin.RerollSubCategory.ChangeStatus');
    });
});
