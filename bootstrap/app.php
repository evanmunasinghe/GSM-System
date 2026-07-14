<?php

use App\Http\Middleware\EnsureUserBelongsToTenant;
use App\Http\Middleware\EnsureUserIsBranchAdmin;
use App\Http\Middleware\EnsureUserIsSuperAdmin;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);

        $middleware->redirectGuestsTo(
            fn (Request $request) => $request->is('admin/*')
                ? route('admin.login')
                : url('/login'),
        );

        $middleware->alias([
            'super.admin' => EnsureUserIsSuperAdmin::class,
            'branch.admin' => EnsureUserIsBranchAdmin::class,
            'tenant.user' => EnsureUserBelongsToTenant::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
