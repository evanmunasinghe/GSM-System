<?php

declare(strict_types=1);

use App\Models\Customer;
use App\Models\VehicleDueRepaire;
use App\Models\VehicleMaintainanceDue;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/login', fn () => Inertia::render('auth/Login', [
        'title' => 'Branch Portal Login',
        'subtitle' => 'Login to manage this branch customers, vehicles, jobs, and invoices.',
        'formAction' => url('/login'),
        'homeUrl' => config('app.url'),
    ]))->name('branch.login');

    Route::get('/dashboard', fn () => Inertia::render('dashboard/Dashboard', [
        'tenant' => [
            'id' => tenant('id'),
            'name' => tenant('com_name'),
        ],
        'stats' => [
            'vehicles' => Vehicle::count(),
            'customers' => Customer::count(),
            'dueRepairs' => VehicleDueRepaire::count(),
            'dueMaintenance' => VehicleMaintainanceDue::count(),
        ],
        'recentVehicles' => Vehicle::latest()
            ->limit(5)
            ->get(['id', 'plate', 'make', 'model', 'vehicletype', 'colour', 'reg_year', 'regdate']),
    ]))->name('branch.dashboard');
});
