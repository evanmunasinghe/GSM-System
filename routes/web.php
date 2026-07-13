<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Stancl\Tenancy\Database\Models\Domain;

Route::get('/', fn () => Inertia::render('Welcome'))
    ->name('home');

Route::get('/branch-portal', fn () => Inertia::render('BranchPortal'))
    ->name('branch.portal');

Route::post('/branch-portal', function (Request $request) {
    $request->validate([
        'branch' => ['required', 'string', 'max:255'],
    ]);

    $branch = strtolower(trim($request->string('branch')->toString()));
    $domainName = str_contains($branch, '.') ? $branch : $branch.'.localhost';
    $domain = Domain::where('domain', $domainName)->first();

    if (! $domain) {
        return back()
            ->withInput()
            ->withErrors(['branch' => 'Branch not found. Please check the branch name.']);
    }

    $port = $request->getPort();
    $portPart = in_array($port, [80, 443], true) ? '' : ':'.$port;

    return Inertia::location(
        $request->getScheme().'://'.$domain->domain.$portPart.'/login'
    );
})->name('branch.portal.redirect');

Route::get('/admin/login', fn () => Inertia::render('Login', [
    'title' => 'Administrative Login',
    'subtitle' => 'Login to manage all branches, users, reports, and system settings.',
    'formAction' => url('/admin/login'),
    'homeUrl' => url('/'),
]))->name('admin.login');
