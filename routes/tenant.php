<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
//route for dash board for branch portal
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/dashboard', function () {
        Customer::firstOrCreate(
            ['email' => 'test@davesautos.com'],
            [
                'name' => 'Dave Test Customer',
                'phone' => '0771234567',
            ]
        );

        return [
            'tenant_id' => tenant('id'),
            'customers_count' => Customer::count(),
            'customers' => Customer::all(['id', 'tenant_id', 'name', 'email', 'phone']),
        ];
    });
});

//login route for branch portal
Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/login', function () {
        return view('auth.login', [
            'title' => 'Branch Portal Login',
            'subtitle' => 'Login to manage this branch customers, vehicles, jobs, and invoices.',
            'formAction' => url('/login'),
        ]);
    })->name('branch.login');

});