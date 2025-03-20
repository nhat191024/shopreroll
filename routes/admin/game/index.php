<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\GameController;

Route::prefix('/game')->name('game.')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('index');
    Route::get('/add', [GameController::class, 'showAddGame'])->name('show_add');
    Route::post('/add', [GameController::class, 'addGame'])->name('add');
    Route::post('/edit', [GameController::class, 'editGame'])->name('edit');
    Route::get('/edit/{id}', [GameController::class, 'showEditGame'])->name('show_edit');
    Route::get('/ChangeStatus/{id}/{status}', [GameController::class, 'ChangeGameStatus'])->name('ChangeStatus');
});
