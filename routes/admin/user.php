<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/add', [UserController::class, 'showAddForm'])->name('show');
    Route::post('/store', [UserController::class, 'store'])->name('add');
    Route::post('/edit/{id}', [UserController::class, 'editUser'])->name('edit');
    Route::get('/{id}', [UserController::class, 'showUser'])->name(name: 'editView');
    Route::get('/changeStatus/{id}', [UserController::class, 'changeStatus'])->name('changeStatus');
});
