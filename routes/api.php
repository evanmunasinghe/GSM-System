<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuth\DiscoveryController;
use App\Http\Controllers\OAuth\IntrospectionController;
use App\Http\Controllers\OAuth\RevocationController;

/*
|--------------------------------------------------------------------------
| Isolated OAuth 2.0 Lifecycle Route Mapping
|--------------------------------------------------------------------------
*/

// Public Metadata Discovery Endpoint
Route::get('/.well-known/oauth-authorization-server', [DiscoveryController::class, 'index']);

// High-Security OAuth Group (Requires Perimeter Gate Validation)
Route::prefix('oauth')->group(function () {
    
    // Handled directly by Laravel Passport engine engine hooks
    Route::post('/token', \Laravel\Passport\Http\Controllers\AccessTokenController::class . '@issueToken');

    // Custom Introspection & Revocation controllers to fulfill contract schemas
    Route::post('/introspect', [IntrospectionController::class, 'introspect']);
    Route::post('/revoke', [RevocationController::class, 'revoke']);
});