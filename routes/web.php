<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CriterionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('criteria', CriterionController::class);
        Route::resource('alternatives', AlternativeController::class)->except(['index', 'show']);
        Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
    });

    Route::resource('alternatives', AlternativeController::class)->only(['index', 'show']);
    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');

    Route::get('/calculations', [CalculationController::class, 'index'])->name('calculations.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});