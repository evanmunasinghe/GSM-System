<?php

use App\Http\Controllers\Admin\SuperAdminDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Stancl\Tenancy\Database\Models\Domain;

Route::get('/', fn () => Inertia::render('Welcome'))
    ->name('home');

Route::get('/branch-portal', fn () => Inertia::render('branch/BranchPortal'))
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

Route::get('/admin/login', [AdminAuthController::class, 'create'])
    ->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('admin.login.store');

Route::prefix('admin')->middleware(['auth', 'super.admin'])->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', SuperAdminDashboardController::class)
        ->name('admin.dashboard');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])
        ->name('admin.logout');
});
