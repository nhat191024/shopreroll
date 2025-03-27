<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RerollSubCategoryController;

Route::prefix('/reroll-sub-category')->name('rerollSubCategory.')->group(function () {
    Route::get('/{category}', [RerollSubCategoryController::class, 'index'])->name('index');
    Route::get('/create/form', [RerollSubCategoryController::class, 'create'])->name('create');
    Route::post('/store', [RerollSubCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RerollSubCategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [RerollSubCategoryController::class, 'update'])->name('update');
    Route::get('/ChangeStatus/{id}', [RerollSubCategoryController::class, 'changeCategoryStatus'])->name('ChangeStatus');
});
