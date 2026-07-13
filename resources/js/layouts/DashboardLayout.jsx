import { Link, router, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import AppFooter from '../components/AppFooter';
import PageStyles from '../components/PageStyles';
import ThemeToggle from '../components/ThemeToggle';

const branchNavigation = [
    { label: 'Dashboard', href: '/dashboard', icon: 'grid' },
    { label: 'Vehicles', icon: 'car', soon: true },
    { label: 'Customers', icon: 'users', soon: true },
    { label: 'Maintenance', icon: 'tool', soon: true },
    { label: 'Repairs', icon: 'repair', soon: true },
    { label: 'Reports', icon: 'chart', soon: true },
];

const adminNavigation = [
    { label: 'Overview', href: '/admin/dashboard', icon: 'grid' },
    { label: 'Branches', icon: 'car', soon: true },
    { label: 'System Users', icon: 'users', soon: true },
    { label: 'Reports', icon: 'chart', soon: true },
];

function NavIcon({ name }) {
    const paths = {
        grid: <><rect x="3" y="3" width="7" height="7" /><rect x="14" y="3" width="7" height="7" /><rect x="3" y="14" width="7" height="7" /><rect x="14" y="14" width="7" height="7" /></>,
        car: <><path d="M5 17h14l1-5-2-5H6l-2 5 1 5Z" /><path d="M7 17v2M17 17v2M4 12h16M7.5 14h.01M16.5 14h.01" /></>,
        users: <><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" /></>,
        tool: <><path d="M14.7 6.3a4 4 0 0 0-5-5L12 3.6 9.6 6 7.3 3.7a4 4 0 0 0 5 5l-8.5 8.5a2.1 2.1 0 0 0 3 3l8.5-8.5a4 4 0 0 0 5-5L18 9l-2.4-2.4 2.3-2.3a4 4 0 0 0-3.2 2Z" /></>,
        repair: <><path d="M14 7 7 14M5 16l3 3M16 5l3 3" /><path d="m14 4 6 6M4 14l6 6M12 12l8 8M4 4l5 5" /></>,
        chart: <><path d="M3 3v18h18" /><path d="m7 16 4-5 4 3 5-7" /></>,
    };

    return (
        <svg className="dashboard-nav-icon" viewBox="0 0 24 24" aria-hidden="true">
            {paths[name]}
        </svg>
    );
}

export default function DashboardLayout({
    title = 'Dashboard',
    variant = 'branch',
    workspace,
    children,
}) {
    const [sidebarOpen, setSidebarOpen] = useState(false);
    const { url, props } = usePage();
    const tenant = props.tenant || {};
    const authUser = props.auth?.user;
    const isAdmin = variant === 'admin';
    const context = workspace || (isAdmin
        ? { id: 'central', name: 'Super Admin' }
        : tenant);
    const navigation = isAdmin ? adminNavigation : branchNavigation;
    const dashboardHref = isAdmin ? '/admin/dashboard' : '/dashboard';
    const profileName = isAdmin
        ? authUser?.name || 'Super Administrator'
        : context.name || 'Branch user';

    useEffect(() => {
        const closeOnEscape = (event) => {
            if (event.key === 'Escape') {
                setSidebarOpen(false);
            }
        };

        window.addEventListener('keydown', closeOnEscape);
        return () => window.removeEventListener('keydown', closeOnEscape);
    }, []);

    return (
        <>
            <PageStyles title={`${title} - FleeV`} />

            <div className={`dashboard-shell ${sidebarOpen ? 'sidebar-is-open' : ''}`}>
                <aside className="dashboard-sidebar" id="dashboard-sidebar">
                    <Link href={dashboardHref} className="dashboard-brand" prefetch onClick={() => setSidebarOpen(false)}>
                        <span className="dashboard-brand-mark" aria-hidden="true">F</span>
                        <span>
                            <strong>FleeV</strong>
                            <small>Garage Management</small>
                        </span>
                    </Link>

                    <div className="dashboard-branch-card">
                        <span className="dashboard-branch-label">
                            {isAdmin ? 'Administration' : 'Current branch'}
                        </span>
                        <strong>{context.name || context.id || 'Workspace'}</strong>
                        {context.id && context.name && <small>{context.id}</small>}
                    </div>

                    <nav className="dashboard-navigation" aria-label="Dashboard navigation">
                        <span className="dashboard-nav-heading">Workspace</span>
                        {navigation.map((item) => {
                            const active = item.href && (url === item.href || url.startsWith(`${item.href}/`));

                            if (!item.href) {
                                return (
                                    <span className="dashboard-nav-link is-disabled" key={item.label}>
                                        <NavIcon name={item.icon} />
                                        <span>{item.label}</span>
                                        {item.soon && <small>Soon</small>}
                                    </span>
                                );
                            }

                            return (
                                <Link
                                    href={item.href}
                                    className={`dashboard-nav-link ${active ? 'is-active' : ''}`}
                                    key={item.label}
                                    prefetch
                                    onClick={() => setSidebarOpen(false)}
                                >
                                    <NavIcon name={item.icon} />
                                    <span>{item.label}</span>
                                </Link>
                            );
                        })}
                    </nav>

                    <div className="dashboard-sidebar-footer">
                        {isAdmin ? (
                            <button
                                className="dashboard-logout-button"
                                type="button"
                                onClick={() => router.post('/admin/logout')}
                            >
                                Sign out
                            </button>
                        ) : (
                            <>
                                <span>Need help?</span>
                                <a href="mailto:support@gms.lk">support@gms.lk</a>
                            </>
                        )}
                    </div>
                </aside>

                <button
                    className="dashboard-sidebar-backdrop"
                    type="button"
                    aria-label="Close navigation"
                    onClick={() => setSidebarOpen(false)}
                />

                <div className="dashboard-workspace">
                    <header className="dashboard-header">
                        <div className="dashboard-header-title">
                            <button
                                className="dashboard-menu-button"
                                type="button"
                                aria-label="Open navigation"
                                aria-controls="dashboard-sidebar"
                                aria-expanded={sidebarOpen}
                                onClick={() => setSidebarOpen(true)}
                            >
                                <svg viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M4 7h16M4 12h16M4 17h16" />
                                </svg>
                            </button>
                            <div>
                                <small>{isAdmin ? 'Central administration' : 'FleeV workspace'}</small>
                                <h1>{title}</h1>
                            </div>
                        </div>

                        <div className="dashboard-header-actions">
                            <div className="dashboard-theme-control">
                                <ThemeToggle />
                            </div>
                            <div className="dashboard-profile" title={profileName}>
                                <span>{profileName.charAt(0).toUpperCase()}</span>
                                <div>
                                    <strong>{profileName}</strong>
                                    <small>{isAdmin ? 'Super administrator' : 'Branch workspace'}</small>
                                </div>
                            </div>
                        </div>
                    </header>

                    <main className="dashboard-content">{children}</main>
                    <AppFooter />
                </div>
            </div>
        </>
    );
}
