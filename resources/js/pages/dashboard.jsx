import { Head } from '@inertiajs/react';

export default function Dashboard({ tenant, vehicles = [] }) {
    return (
        <>
            <Head title="FleeV Dashboard" />
            <main className="min-h-screen bg-slate-950 p-8 text-white">
                <div className="mx-auto max-w-6xl">
                    <p className="text-sm font-semibold uppercase tracking-wider text-orange-400">
                        {tenant?.name || tenant?.id || 'Branch'}
                    </p>
                    <h1 className="mt-2 text-4xl font-bold">FleeV Dashboard</h1>
                    <p className="mt-4 text-slate-300">
                        {vehicles.length} {vehicles.length === 1 ? 'vehicle' : 'vehicles'} found.
                    </p>
                </div>
            </main>
        </>
    );
}
