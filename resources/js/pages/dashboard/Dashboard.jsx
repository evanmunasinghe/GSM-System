import DashboardLayout from '../../layouts/DashboardLayout';

const statCards = [
    { key: 'vehicles', label: 'Total vehicles', symbol: 'V' },
    { key: 'customers', label: 'Customers', symbol: 'C' },
    { key: 'dueRepairs', label: 'Due repairs', symbol: 'R' },
    { key: 'dueMaintenance', label: 'Due maintenance', symbol: 'M' },
];

export default function Dashboard({ tenant, stats = {}, recentVehicles = [] }) {
    return (
        <DashboardLayout title="Dashboard">
            <section className="dashboard-page-heading">
                <div>
                    <p>Branch overview</p>
                    <h2>Welcome back to {tenant?.name || 'FleeV'}</h2>
                </div>
                <span>Everything important, in one place.</span>
            </section>

            <section className="dashboard-stat-grid" aria-label="Branch statistics">
                {statCards.map((card) => (
                    <article className="dashboard-stat-card" key={card.key}>
                        <span className="dashboard-stat-icon" aria-hidden="true">{card.symbol}</span>
                        <div>
                            <small>{card.label}</small>
                            <strong>{stats[card.key] ?? 0}</strong>
                        </div>
                    </article>
                ))}
            </section>

            <section className="dashboard-panel">
                <div className="dashboard-panel-header">
                    <h3>Recently added vehicles</h3>
                    <span>Latest 5 records</span>
                </div>

                {recentVehicles.length > 0 ? (
                    <div className="dashboard-table-wrap">
                        <table className="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Plate</th>
                                    <th>Vehicle</th>
                                    <th>Type</th>
                                    <th>Colour</th>
                                    <th>Registration</th>
                                </tr>
                            </thead>
                            <tbody>
                                {recentVehicles.map((vehicle) => (
                                    <tr key={vehicle.id}>
                                        <td><strong>{vehicle.plate}</strong></td>
                                        <td>{[vehicle.make, vehicle.model].filter(Boolean).join(' ') || '—'}</td>
                                        <td>{vehicle.vehicletype || '—'}</td>
                                        <td>{vehicle.colour || '—'}</td>
                                        <td>{vehicle.regdate || vehicle.reg_year || '—'}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                ) : (
                    <div className="dashboard-empty-state">
                        No vehicles have been added to this branch yet.
                    </div>
                )}
            </section>
        </DashboardLayout>
    );
}
