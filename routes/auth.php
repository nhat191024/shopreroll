<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::prefix('/login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/auth', [LoginController::class, 'login'])->name('login.auth');
});
Route::prefix('/register')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->name('register');
    Route::post('/auth', [RegisterController::class, 'register'])->name('register.auth');
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
