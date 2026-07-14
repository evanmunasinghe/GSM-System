@extends('layouts.dashboard', [
    'dashboardTitle' => 'Branch Admin Panel',
    'variant' => 'branch',
    'workspace' => $tenant,
])

@section('dashboard-content')
    @include('branch.partials.vehicle-dashboard', ['adminView' => true])
@endsection
