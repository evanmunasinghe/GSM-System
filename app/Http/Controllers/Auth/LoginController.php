<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login', [
            'credentials' => app()->isLocal() ? [
                [
                    'label' => 'Super Admin',
                    'email' => config('auth.super_admin.email'),
                    'password' => config('auth.super_admin.password'),
                ],
                [
                    'label' => 'Jayarathna Auto',
                    'email' => config('auth.branch_admin.email'),
                    'password' => config('auth.branch_admin.password'),
                ],
            ] : [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['sometimes', 'boolean'],
        ]);

        $user = User::withoutGlobalScopes()
            ->where('email', $credentials['email'])
            ->get()
            ->first(fn (User $candidate) => Hash::check($credentials['password'], $candidate->pw));

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match a FleeV account.',
            ]);
        }

        $branchDomain = null;

        if (! $user->isSuperAdmin()) {
            $branchDomain = Tenant::find($user->tenant_id)?->domains()->first();

            if (! $branchDomain) {
                throw ValidationException::withMessages([
                    'email' => 'This account is not connected to an active branch.',
                ]);
            }
        }

        if ($user->isSuperAdmin()) {
            Auth::login($user, (bool) ($credentials['remember'] ?? false));
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        $token = Str::random(64);
        Cache::put('login-handoff:'.hash('sha256', $token), [
            'user_id' => $user->id,
            'tenant_id' => $user->tenant_id,
            'remember' => (bool) ($credentials['remember'] ?? false),
        ], now()->addMinute());

        $port = $request->getPort();
        $portPart = in_array($port, [80, 443], true) ? '' : ':'.$port;

        return redirect()->away(
            $request->getScheme().'://'.$branchDomain->domain.$portPart.'/login/handoff?token='.urlencode($token)
        );
    }

    public function handoff(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required', 'string', 'size:64'],
        ]);

        $payload = tenancy()->central(
            fn () => Cache::pull('login-handoff:'.hash('sha256', $request->string('token')->toString()))
        );

        abort_unless(
            is_array($payload) && (string) ($payload['tenant_id'] ?? '') === (string) tenant('id'),
            403,
        );

        $user = User::find($payload['user_id'] ?? null);
        abort_unless($user, 403);

        Auth::login($user, (bool) ($payload['remember'] ?? false));
        $request->session()->regenerate();

        return redirect()->route('branch.dashboard');
    }

    public function redirect(Request $request): RedirectResponse
    {
        return redirect()->away($this->centralHomeUrl($request).'login');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->away($this->centralHomeUrl($request).'login');
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
