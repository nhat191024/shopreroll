<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GameItemTypeController;

Route::prefix('/game_item_type')->name('game_item_type.')->group(function () {
    Route::get('/{game_id}', [GameItemTypeController::class, 'index'])->name('index');
});
