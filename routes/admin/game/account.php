<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameAccountController;

Route::prefix('/game-account')->name('gameAccount.')->group(function () {
    Route::get('/', [GameAccountController::class, 'index'])->name('index');
    Route::get('/add', [GameAccountController::class, 'showAddForm'])->name('showAddForm');
    Route::post('/add', [GameAccountController::class, 'addGameAccount'])->name('add');
    Route::post('/edit/{id}', [GameAccountController::class, 'editGameAccount'])->name('edit');
    Route::get('/edit/{id}', [GameAccountController::class, 'showEditForm'])->name('showEditForm');
    Route::get('/disable/{id}', [GameAccountController::class, 'disableGameAccount'])->name('disable');
    Route::get('/store/{id}', [GameAccountController::class, 'storeGameAccount'])->name('store');
    Route::get('/get-game-details/{categoryId}', [GameAccountController::class, 'getGameDetails'])->name('getGameDetails');
    Route::post('/game-account/import', [GameAccountController::class, 'importFromExcel'])->name('import');
});
