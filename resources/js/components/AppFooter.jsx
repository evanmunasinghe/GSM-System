import { usePage } from '@inertiajs/react';

export default function AppFooter() {
    const { app = {} } = usePage().props;

    return (
        <footer className="app-footer">
            <div className="container">
                <div className="footer-content">
                    <span>© {app.year || new Date().getFullYear()} FleeV Garage Management System</span>
                    <span>Version {app.version || '1.0.0'}</span>
                    <span>Contact: support@gms.lk | 077 123 4567</span>
                </div>
            </div>
        </footer>
    );
}
