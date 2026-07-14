<?php

use App\Http\Controllers\Admin\SuperAdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('login.store');
Route::get('/admin/login', [LoginController::class, 'redirect']);

Route::prefix('admin')->middleware(['auth', 'super.admin'])->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', SuperAdminDashboardController::class)
        ->name('admin.dashboard');
    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('admin.logout');
});
