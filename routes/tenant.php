<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\BranchAuthController;
use App\Http\Controllers\Branch\BranchDashboardController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/login', [BranchAuthController::class, 'create'])
        ->name('branch.login');
    Route::post('/login', [BranchAuthController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('branch.login.store');

    Route::middleware(['auth', 'tenant.user'])->group(function () {
        Route::get('/dashboard', BranchDashboardController::class)
            ->name('branch.dashboard');
        Route::post('/logout', [BranchAuthController::class, 'destroy'])
            ->name('branch.logout');
    });
});
