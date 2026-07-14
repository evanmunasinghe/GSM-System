<section class="dashboard-page-heading">
    <div>
        <p>{{ $adminView ? 'Branch administration' : 'Branch overview' }}</p>
        <h2>{{ $adminView ? 'Welcome to' : 'Welcome back to' }} {{ $tenant['name'] ?? 'FleeV' }}</h2>
    </div>
    <span>{{ $adminView ? 'Manage your branch from one workspace.' : 'Everything important, in one place.' }}</span>
</section>

<section class="dashboard-stat-grid" aria-label="Branch statistics">
    @foreach ([
        ['key' => 'vehicles', 'label' => 'Total vehicles', 'symbol' => 'V'],
        ['key' => 'customers', 'label' => 'Customers', 'symbol' => 'C'],
        ['key' => 'dueRepairs', 'label' => 'Due repairs', 'symbol' => 'R'],
        ['key' => 'dueMaintenance', 'label' => 'Due maintenance', 'symbol' => 'M'],
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
        <h3>Recently added vehicles</h3>
        <span>Latest 5 records</span>
    </div>

    @if ($recentVehicles->isNotEmpty())
        <div class="dashboard-table-wrap">
            <table class="dashboard-table">
                <thead>
                    <tr><th>Plate</th><th>Vehicle</th><th>Type</th><th>Colour</th><th>Registration</th></tr>
                </thead>
                <tbody>
                    @foreach ($recentVehicles as $vehicle)
                        <tr>
                            <td><strong>{{ $vehicle->plate }}</strong></td>
                            <td>{{ trim($vehicle->make.' '.$vehicle->model) ?: '—' }}</td>
                            <td>{{ $vehicle->vehicletype ?: '—' }}</td>
                            <td>{{ $vehicle->colour ?: '—' }}</td>
                            <td>{{ $vehicle->regdate?->format('M j, Y') ?? $vehicle->reg_year ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="dashboard-empty-state">No vehicles have been added to this branch yet.</div>
    @endif
</section>
