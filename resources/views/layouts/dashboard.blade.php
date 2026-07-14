@extends('layouts.app')

@php
    $isAdmin = ($variant ?? 'branch') === 'admin';
    $context = $workspace ?? ['id' => tenant('id'), 'name' => tenant('com_name')];
    $user = auth()->user();
    $profileName = $user?->user ?? ($isAdmin ? 'Super Administrator' : 'Branch user');
    $profileRole = $isAdmin ? 'Super administrator' : \Illuminate\Support\Str::headline($user?->type ?? 'branch user');
    $dashboardRoute = $isAdmin ? 'admin.dashboard' : 'branch.dashboard';
    $logoutRoute = $isAdmin ? 'admin.logout' : 'branch.logout';
    $navigation = $isAdmin
        ? [
            ['label' => 'Overview', 'route' => 'admin.dashboard', 'icon' => 'grid'],
            ['label' => 'Branches', 'route' => null, 'icon' => 'car', 'soon' => true],
            ['label' => 'System Users', 'route' => null, 'icon' => 'users', 'soon' => true],
            ['label' => 'Reports', 'route' => null, 'icon' => 'chart', 'soon' => true],
        ]
        : [
            ['label' => 'Dashboard', 'route' => 'branch.dashboard', 'icon' => 'grid'],
            ['label' => 'Vehicles', 'route' => null, 'icon' => 'car', 'soon' => true],
            ['label' => 'Customers', 'route' => null, 'icon' => 'users', 'soon' => true],
            ['label' => 'Maintenance', 'route' => null, 'icon' => 'tool', 'soon' => true],
            ['label' => 'Repairs', 'route' => null, 'icon' => 'repair', 'soon' => true],
            ['label' => 'Reports', 'route' => null, 'icon' => 'chart', 'soon' => true],
        ];
@endphp

@section('title', ($dashboardTitle ?? 'Dashboard').' - FleeV')

@section('content')
    <div class="dashboard-shell" data-dashboard-shell>
        <aside class="dashboard-sidebar" id="dashboard-sidebar">
            <a href="{{ route($dashboardRoute) }}" class="dashboard-brand">
                <span class="dashboard-brand-mark" aria-hidden="true">F</span>
                <span>
                    <strong>FleeV</strong>
                    <small>Garage Management</small>
                </span>
            </a>

            <div class="dashboard-branch-card">
                <span class="dashboard-branch-label">{{ $isAdmin ? 'Administration' : 'Current branch' }}</span>
                <strong>{{ $context['name'] ?? $context['id'] ?? 'Workspace' }}</strong>
                @if (! empty($context['id']) && ! empty($context['name']))
                    <small>{{ $context['id'] }}</small>
                @endif
            </div>

            <nav class="dashboard-navigation" aria-label="Dashboard navigation">
                <span class="dashboard-nav-heading">Workspace</span>
                @foreach ($navigation as $item)
                    @if ($item['route'])
                        <a
                            href="{{ route($item['route']) }}"
                            class="dashboard-nav-link {{ request()->routeIs($item['route']) ? 'is-active' : '' }}"
                        >
                            <x-dashboard-nav-icon :name="$item['icon']" />
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @else
                        <span class="dashboard-nav-link is-disabled">
                            <x-dashboard-nav-icon :name="$item['icon']" />
                            <span>{{ $item['label'] }}</span>
                            @if ($item['soon'] ?? false)<small>Soon</small>@endif
                        </span>
                    @endif
                @endforeach
            </nav>

            <div class="dashboard-sidebar-footer">
                <form method="POST" action="{{ route($logoutRoute) }}">
                    @csrf
                    <button class="dashboard-logout-button" type="submit">Sign out</button>
                </form>
                @unless ($isAdmin)
                    <a href="mailto:support@fleev.lk">support@fleev.lk</a>
                @endunless
            </div>
        </aside>

        <button
            class="dashboard-sidebar-backdrop"
            type="button"
            aria-label="Close navigation"
            data-sidebar-backdrop
        ></button>

        <div class="dashboard-workspace">
            <header class="dashboard-header">
                <div class="dashboard-header-title">
                    <button
                        class="dashboard-menu-button"
                        type="button"
                        aria-label="Open navigation"
                        aria-controls="dashboard-sidebar"
                        aria-expanded="false"
                        data-sidebar-toggle
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 7h16M4 12h16M4 17h16" />
                        </svg>
                    </button>
                    <div>
                        <small>{{ $isAdmin ? 'Central administration' : 'FleeV workspace' }}</small>
                        <h1>{{ $dashboardTitle ?? 'Dashboard' }}</h1>
                    </div>
                </div>

                <div class="dashboard-header-actions">
                    <div class="dashboard-theme-control">
                        <x-theme-toggle />
                    </div>
                    <div class="dashboard-profile" title="{{ $profileName }}">
                        <span>{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($profileName, 0, 1)) }}</span>
                        <div>
                            <strong>{{ $profileName }}</strong>
                            <small>{{ $profileRole }}</small>
                        </div>
                    </div>
                </div>
            </header>

            <main class="dashboard-content">
                @yield('dashboard-content')
            </main>
            <x-app-footer />
        </div>
    </div>
@endsection
