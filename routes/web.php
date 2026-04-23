<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CriterionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('criteria', CriterionController::class);
    Route::resource('alternatives', AlternativeController::class);

    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
    Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');

    Route::get('/calculations', [CalculationController::class, 'index'])->name('calculations.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});