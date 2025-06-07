<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RerollKeyController;

Route::prefix('/reroll-key')->name('rerollKey.')->group(function () {
    Route::get('/{id}', [RerollKeyController::class, 'index'])->name('index');
    Route::get('/create/{package}', [RerollKeyController::class, 'create'])->name('create');
    Route::post('/store', [RerollKeyController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RerollKeyController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [RerollKeyController::class, 'update'])->name('update');
    Route::get('/destroy/{idKey}', [RerollKeyController::class, 'destroy'])->name('destroy');
});
