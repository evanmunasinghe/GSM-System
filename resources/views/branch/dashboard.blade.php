@extends('layouts.dashboard', [
    'dashboardTitle' => 'Dashboard',
    'variant' => 'branch',
    'workspace' => $tenant,
])

@section('dashboard-content')
    @include('branch.partials.vehicle-dashboard', ['adminView' => false])
@endsection
