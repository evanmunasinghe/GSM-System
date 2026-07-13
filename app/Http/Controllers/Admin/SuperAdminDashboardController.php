<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Vehicle;
use Inertia\Inertia;
use Inertia\Response;
use Stancl\Tenancy\Database\Models\Domain;

class SuperAdminDashboardController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('admin/SuperAdminDashboard', [
            'workspace' => [
                'id' => 'central',
                'name' => 'Super Admin',
            ],
            'stats' => [
                'tenants' => Tenant::whereKeyNot('fleev-system')->count(),
                'domains' => Domain::count(),
                'users' => User::where('type', '!=', User::TYPE_SUPER_ADMIN)->count(),
                'vehicles' => Vehicle::count(),
                'customers' => Customer::count(),
            ],
            'recentTenants' => Tenant::query()
                ->whereKeyNot('fleev-system')
                ->latest()
                ->limit(5)
                ->get(['id', 'com_name', 'email', 'tel', 'created_at']),
        ]);
    }
}
