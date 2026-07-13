import DashboardLayout from '../../layouts/DashboardLayout';

const statCards = [
    { key: 'tenants', label: 'Active branches', symbol: 'B' },
    { key: 'domains', label: 'Mapped domains', symbol: 'D' },
    { key: 'users', label: 'Branch users', symbol: 'U' },
    { key: 'vehicles', label: 'Total vehicles', symbol: 'V' },
];

export default function SuperAdminDashboard({ workspace, stats = {}, recentTenants = [] }) {
    return (
        <DashboardLayout title="Super Admin Panel" variant="admin" workspace={workspace}>
            <section className="dashboard-page-heading">
                <div>
                    <p>System overview</p>
                    <h2>FleeV central administration</h2>
                </div>
                <span>{stats.customers ?? 0} customers across all branches</span>
            </section>

            <section className="dashboard-stat-grid" aria-label="System statistics">
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
                    <h3>Recently created branches</h3>
                    <span>Latest 5 tenants</span>
                </div>

                {recentTenants.length > 0 ? (
                    <div className="dashboard-table-wrap">
                        <table className="dashboard-table">
                            <thead>
                                <tr>
                                    <th>Tenant ID</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                {recentTenants.map((tenant) => (
                                    <tr key={tenant.id}>
                                        <td><strong>{tenant.id}</strong></td>
                                        <td>{tenant.com_name}</td>
                                        <td>{tenant.email || '—'}</td>
                                        <td>{tenant.tel || '—'}</td>
                                        <td>{tenant.created_at
                                            ? new Date(tenant.created_at).toLocaleDateString()
                                            : '—'}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                ) : (
                    <div className="dashboard-empty-state">
                        No branch tenants have been created yet.
                    </div>
                )}
            </section>
        </DashboardLayout>
    );
}
