<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RerollPackageController;

Route::prefix('/reroll-package')->name('RerollPackage.')->group(function () {
    Route::get('/', [RerollPackageController::class, 'index'])->name('index');
    Route::get('/add', [RerollPackageController::class, 'showAddRerollPackage'])->name('showAdd');
    Route::post('/add', [RerollPackageController::class, 'addRerollPackage'])->name('add');
    Route::post('/edit', [RerollPackageController::class, 'editRerollPackage'])->name('edit');
    Route::get('/edit/{id}', [RerollPackageController::class, 'showEditRerollPackage'])->name('showEdit');
    Route::get('/delete/{id}', [RerollPackageController::class, 'deleteRerollPackage'])->name('delete');
    Route::get('/detail/{id}', [RerollPackageController::class, 'detailRerollPackage'])->name('detail');

    require __DIR__ . '/subCategory.php';
});
