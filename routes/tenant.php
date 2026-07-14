<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Branch\BranchDashboardController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/login/handoff', [LoginController::class, 'handoff'])
        ->middleware('throttle:10,1')
        ->name('branch.login.handoff');

    Route::middleware(['auth', 'tenant.user'])->group(function () {
        Route::get('/dashboard', BranchDashboardController::class)
            ->name('branch.dashboard');
        Route::post('/logout', [LoginController::class, 'destroy'])
            ->name('branch.logout');
    });
});
