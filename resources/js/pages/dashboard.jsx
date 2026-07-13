import { Head } from '@inertiajs/react';

export default function Dashboard({ vehicles }) {
    return (
        <>
            <Head title="FleeV Dashboard" />

            <main>
                <h1>FleeV Dashboard</h1>
                <p>{vehicles.length} vehicles found.</p>
            </main>
        </>
    );
}