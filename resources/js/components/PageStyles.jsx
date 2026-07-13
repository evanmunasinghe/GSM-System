import { Head } from '@inertiajs/react';

export default function PageStyles({ title, stylesheet }) {
    return (
        <Head title={title}>
            <link
                head-key="bootstrap-styles"
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            />
            <link head-key="page-styles" rel="stylesheet" href={`/css/${stylesheet}`} />
            <link head-key="component-styles" rel="stylesheet" href="/css/components.css" />
        </Head>
    );
}
