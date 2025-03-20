<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RerollCategoryController;

Route::prefix('/reroll-category')->name('RerollCategory.')->group(function () {
    Route::get('/', [RerollCategoryController::class, 'index'])->name('index');
    Route::get('/add', [RerollCategoryController::class, 'showAddRerollCategory'])->name('showAdd');
    Route::post('/add', [RerollCategoryController::class, 'addRerollCategory'])->name('add');
    Route::post('/edit', [RerollCategoryController::class, 'editRerollCategory'])->name('edit');
    Route::get('/edit/{id}', [RerollCategoryController::class, 'showEditRerollCategory'])->name('ShowEdit');
    Route::get('/detail/{id}', [RerollCategoryController::class, 'detailRerollCategory'])->name('Detail');
    Route::get('/ChangeStatus/{id}', [RerollCategoryController::class, 'ChangeCategoryStatus'])->name('ChangeStatus');
});
