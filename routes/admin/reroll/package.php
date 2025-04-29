<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RerollPackageController;

Route::prefix('/reroll-package')->name('rerollPackage.')->group(function () {
    Route::get('/{subCategory}', [RerollPackageController::class, 'index'])->name('index');
    Route::get('/create/form', [RerollPackageController::class, 'create'])->name('create');
    Route::post('/store', [RerollPackageController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RerollPackageController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [RerollPackageController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [RerollPackageController::class, 'destroy'])->name('destroy');
});
