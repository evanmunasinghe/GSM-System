<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;


//branch-portal to enter the branch code to access the branch portal
Route::get('/branch-portal', function () {
    return view('branch.portal');
})->name('branch.portal');

Route::post('/branch-portal', function (Request $request) {
    $request->validate([
        'branch' => ['required', 'string', 'max:255'],
    ]);

    $branch = strtolower(trim($request->branch));

    // If user enters "davesautos", convert it to "davesautos.localhost"
    // If user enters "davesautos.localhost", keep it as it is.
    $domainName = str_contains($branch, '.')
        ? $branch
        : $branch . '.localhost';

    $domain = Domain::where('domain', $domainName)->first();

    if (! $domain) {
        return back()
            ->withInput()
            ->withErrors([
                'branch' => 'Branch not found. Please check the branch name.',
            ]);
    }

    $scheme = $request->getScheme(); // http or https
    $port = $request->getPort();

    $portPart = in_array($port, [80, 443]) ? '' : ':' . $port;

    return redirect()->away($scheme . '://' . $domain->domain . $portPart . '/login');
})->name('branch.portal.redirect');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/login', function () {
    return view('auth.login', [
        'title' => 'Administrative Login',
        'subtitle' => 'Login to manage all branches, users, reports, and system settings.',
        'formAction' => url('/admin/login'),
    ]);
})->name('admin.login');
