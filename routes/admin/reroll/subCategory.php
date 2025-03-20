<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RerollSubCategoryController;

Route::prefix('/reroll-sub-category')->name('rerollSubCategory.')->group(function () {
    Route::get('/', [RerollSubCategoryController::class, 'index'])->name('index');
    Route::get('/add', [RerollSubCategoryController::class, 'showAddRerollSubCategory'])->name('showAdd');
    Route::post('/add', [RerollSubCategoryController::class, 'addRerollSubCategory'])->name('add');
    Route::post('/edit', [RerollSubCategoryController::class, 'editRerollSubCategory'])->name('edit');
    Route::get('/edit/{id}', [RerollSubCategoryController::class, 'showEditRerollSubCategory'])->name('ShowEdit');
    Route::get('/detail/{id}', [RerollSubCategoryController::class, 'detailRerollSubCategory'])->name('Detail');
    Route::get('/ChangeStatus/{id}', [RerollSubCategoryController::class, 'ChangeCategoryStatus'])->name('ChangeStatus');
});
