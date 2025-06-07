<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/settings')->name('settings.')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');
    Route::post('/update', [SettingController::class, 'update'])->name('update');
});
