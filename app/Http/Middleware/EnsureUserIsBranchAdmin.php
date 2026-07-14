<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsBranchAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $tenantId = tenant('id');

        abort_unless(
            $user?->isBranchAdmin() && (string) $user->tenant_id === (string) $tenantId,
            403,
        );

        return $next($request);
    }
}
