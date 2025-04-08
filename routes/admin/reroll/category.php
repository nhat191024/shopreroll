<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RerollCategoryController;

Route::prefix('/reroll-category')->name('rerollCategory.')->group(function () {
    Route::get('/', [RerollCategoryController::class, 'index'])->name('index');
    Route::get('/add', [RerollCategoryController::class, 'create'])->name('create');
    Route::post('/store', [RerollCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RerollCategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [RerollCategoryController::class, 'update'])->name('update');
    Route::get('/ChangeStatus/{id}', [RerollCategoryController::class, 'ChangeCategoryStatus'])->name('ChangeStatus');
});
