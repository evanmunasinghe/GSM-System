<?php

use App\Http\Middleware\EnsureUserBelongsToTenant;
use App\Http\Middleware\EnsureUserIsSuperAdmin;
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
        $middleware->redirectGuestsTo(function (Request $request): string {
            $homeUrl = rtrim((string) config('app.url'), '/');
            $port = $request->getPort();

            if (parse_url($homeUrl, PHP_URL_PORT) === null && ! in_array($port, [80, 443], true)) {
                $homeUrl .= ':'.$port;
            }

            return $homeUrl.'/login';
        });

        $middleware->alias([
            'super.admin' => EnsureUserIsSuperAdmin::class,
            'tenant.user' => EnsureUserBelongsToTenant::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
