<?php

declare(strict_types=1);

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
    Route::get('/login', fn () => Inertia::render('Login', [
        'title' => 'Branch Portal Login',
        'subtitle' => 'Login to manage this branch customers, vehicles, jobs, and invoices.',
        'formAction' => url('/login'),
        'homeUrl' => config('app.url'),
    ]))->name('branch.login');

    Route::get('/dashboard', fn () => Inertia::render('dashboard', [
        'tenant' => [
            'id' => tenant('id'),
            'name' => tenant('com_name'),
        ],
        'vehicles' => Vehicle::latest()->get(),
    ]))->name('branch.dashboard');
});
