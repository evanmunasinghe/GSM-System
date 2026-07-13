import { Link } from '@inertiajs/react';
import PageStyles from '../components/PageStyles';
import PublicLayout from '../components/PublicLayout';

const features = [
    'Customer Management',
    'Vehicle Service Records',
    'Branch-wise Data',
    'Reports & Invoices',
];

export default function Welcome() {
    return (
        <PublicLayout>
            <PageStyles title="FleeV" />

            <main className="welcome-wrapper">
                <div className="container">
                    <div className="row align-items-center min-vh-100">
                        <div className="col-lg-6 text-center text-lg-start">
                            <div className="brand-badge mb-4">
                                FleeV Garage Management System V1.0.1
                            </div>

                            <h1 className="main-title">
                                Manage Your Garage Smarter with <span>FleeV</span>
                            </h1>

                            <p className="main-description">
                                A complete garage management solution for handling customers,
                                vehicles, jobs, invoices, stock, employees, and branch operations
                                from one powerful system.
                            </p>

                            <div className="button-group mt-5">
                                <Link href="/admin/login" className="btn btn-admin" prefetch>
                                    Administrative Login
                                </Link>
                                <Link href="/branch-portal" className="btn btn-branch" prefetch>
                                    Branch Portal
                                </Link>
                            </div>
                        </div>

                        <div className="col-lg-6 mt-5 mt-lg-0">
                            <div className="system-card mx-auto">
                                <div className="card-icon">🔧</div>
                                <h3>Garage Operations</h3>
                                <p>
                                    Track repairs, customer records, spare parts, service history,
                                    payments, and branch activities with ease.
                                </p>
                                <div className="features">
                                    {features.map((feature) => (
                                        <div className="feature-item" key={feature}>
                                            <span>✓</span> {feature}
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </PublicLayout>
    );
}
