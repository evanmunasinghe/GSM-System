@extends('layouts.dashboard', [
    'dashboardTitle' => 'Super Admin Panel',
    'variant' => 'admin',
    'workspace' => $workspace,
])

@section('dashboard-content')
    <section class="dashboard-page-heading">
        <div>
            <p>System overview</p>
            <h2>FleeV central administration</h2>
        </div>
        <span>{{ $stats['customers'] ?? 0 }} customers across all branches</span>
    </section>

    <section class="dashboard-stat-grid" aria-label="System statistics">
        @foreach ([
            ['key' => 'tenants', 'label' => 'Active branches', 'symbol' => 'B'],
            ['key' => 'domains', 'label' => 'Mapped domains', 'symbol' => 'D'],
            ['key' => 'users', 'label' => 'Branch users', 'symbol' => 'U'],
            ['key' => 'vehicles', 'label' => 'Total vehicles', 'symbol' => 'V'],
        ] as $card)
            <article class="dashboard-stat-card">
                <span class="dashboard-stat-icon" aria-hidden="true">{{ $card['symbol'] }}</span>
                <div>
                    <small>{{ $card['label'] }}</small>
                    <strong>{{ $stats[$card['key']] ?? 0 }}</strong>
                </div>
            </article>
        @endforeach
    </section>

    <section class="dashboard-panel">
        <div class="dashboard-panel-header">
            <h3>Recently created branches</h3>
            <span>Latest 5 tenants</span>
        </div>

        @if ($recentTenants->isNotEmpty())
            <div class="dashboard-table-wrap">
                <table class="dashboard-table">
                    <thead>
                        <tr><th>Tenant ID</th><th>Company</th><th>Email</th><th>Telephone</th><th>Created</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($recentTenants as $recentTenant)
                            <tr>
                                <td><strong>{{ $recentTenant->id }}</strong></td>
                                <td>{{ $recentTenant->com_name }}</td>
                                <td>{{ $recentTenant->email ?: '—' }}</td>
                                <td>{{ $recentTenant->tel ?: '—' }}</td>
                                <td>{{ $recentTenant->created_at?->format('M j, Y') ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="dashboard-empty-state">No branch tenants have been created yet.</div>
        @endif
    </section>
@endsection
