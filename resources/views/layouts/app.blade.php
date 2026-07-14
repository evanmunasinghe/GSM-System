<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FleeV')</title>

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
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/components.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>
