<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RerollKeyController;

Route::prefix('/detail/{idPackage}/reroll-key')->name('RerollKey.')->group(function () {
    Route::get('/', [RerollKeyController::class, 'index'])->name('index');
    Route::get('/add', [RerollKeyController::class, 'showAddRerollKey'])->name('showAdd');
    Route::post('/add', [RerollKeyController::class, 'addRerollKey'])->name('add');
    Route::post('/edit', [RerollKeyController::class, 'editRerollKey'])->name('edit');
    Route::get('/edit/{idKey}', [RerollKeyController::class, 'showEditRerollKey'])->name('ShowEdit');
    Route::get('/delete/{idKey}', [RerollKeyController::class, 'deleteRerollPackage'])->name('delete');
});
