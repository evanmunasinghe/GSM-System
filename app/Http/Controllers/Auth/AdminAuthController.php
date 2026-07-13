<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class AdminAuthController extends Controller
{
    public function create(Request $request): Response|RedirectResponse
    {
        if ($request->user()?->isSuperAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return Inertia::render('auth/Login', [
            'title' => 'Administrative Login',
            'subtitle' => 'Login to manage all branches, users, reports, and system settings.',
            'formAction' => route('admin.login.store'),
            'homeUrl' => route('home'),
            'credentials' => app()->isLocal() ? [
                'email' => config('auth.super_admin.email'),
                'password' => config('auth.super_admin.password'),
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
            'type' => User::TYPE_SUPER_ADMIN,
        ], (bool) ($credentials['remember'] ?? false));

        if (! $authenticated) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match a super administrator account.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
