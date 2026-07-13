<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        (() => {
            try {
                const savedTheme = localStorage.getItem('gms-theme');
                document.documentElement.dataset.theme = savedTheme === 'light' ? 'light' : 'dark';
            } catch (error) {
                document.documentElement.dataset.theme = 'dark';
            }
        })();
    </script>

    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/welcome.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/branch-portal.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/components.css">

    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])

    <x-inertia::head>
        <title>FleeV</title>
    </x-inertia::head>
</head>
<body>
    <x-inertia::app />
</body>
</html>
