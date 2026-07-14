<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class BranchAuthController extends Controller
{
    public function create(Request $request): Response|RedirectResponse
    {
        if ((string) $request->user()?->tenant_id === (string) tenant('id')) {
            return redirect()->route('branch.dashboard');
        }

        $tenantName = tenant('com_name') ?: 'Branch';

        return Inertia::render('auth/Login', [
            'title' => $tenantName.' Login',
            'subtitle' => 'Sign in to access your branch workspace.',
            'formAction' => url('/login'),
            'homeUrl' => $this->centralHomeUrl($request),
            'credentials' => app()->isLocal() && tenant('id') === 'jayarathna-auto' ? [
                'email' => config('auth.branch_admin.email'),
                'password' => config('auth.branch_admin.password'),
            ] : null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ]);

        $authenticated = Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'tenant_id' => tenant('id'),
        ], (bool) ($credentials['remember'] ?? false));

        if (! $authenticated) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match an account for this branch.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('branch.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('branch.login');
    }

    private function centralHomeUrl(Request $request): string
    {
        $homeUrl = rtrim((string) config('app.url'), '/');
        $port = $request->getPort();

        if (parse_url($homeUrl, PHP_URL_PORT) === null && ! in_array($port, [80, 443], true)) {
            $homeUrl .= ':'.$port;
        }

        return $homeUrl.'/';
    }
}
