<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\VehicleDueRepaire;
use App\Models\VehicleMaintainanceDue;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $page = $request->user()->isBranchAdmin()
            ? 'branch.admin-dashboard'
            : 'branch.dashboard';

        return view($page, [
            'tenant' => [
                'id' => tenant('id'),
                'name' => tenant('com_name'),
            ],
            'stats' => [
                'vehicles' => Vehicle::count(),
                'customers' => Customer::count(),
                'dueRepairs' => VehicleDueRepaire::count(),
                'dueMaintenance' => VehicleMaintainanceDue::count(),
            ],
            'recentVehicles' => Vehicle::latest()
                ->limit(5)
                ->get(['id', 'plate', 'make', 'model', 'vehicletype', 'colour', 'reg_year', 'regdate']),
        ]);
    }
}
