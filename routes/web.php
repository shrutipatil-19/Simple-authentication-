<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\loginController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Public routes (guest middleware)
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('account.login');
    Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    Route::get('/register', [LoginController::class, 'register'])->name('account.register');
    Route::post('/register/process', [LoginController::class, 'processregister'])->name('account.processRegister');
});

// Protected routes (auth middleware)
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('account.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});







