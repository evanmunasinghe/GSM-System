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
