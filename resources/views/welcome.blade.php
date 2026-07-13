<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleeV</title>
    <x-theme-head />

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>
<body>
    <x-theme-toggle />

    <main class="welcome-wrapper">
        <div class="container">
            <div class="row align-items-center min-vh-100">

                {{-- Left Content --}}
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="brand-badge mb-4">
                        FleeV Garage Management System V1.0.1
                    </div>

                    <h1 class="main-title">
                        Manage Your Garage Smarter with <span>FleeV</span>
                    </h1>

                    <p class="main-description">
                        A complete garage management solution for handling customers,
                        vehicles, jobs, invoices, stock, employees, and branch operations
                        from one powerful system.
                    </p>

                    <div class="button-group mt-5">
                        <a href="{{ url('/admin/login') }}" class="btn btn-admin">
                            Administrative Login
                        </a>

                        <a href="{{ url('/branch-portal') }}" class="btn btn-branch">
                            Branch Portal
                        </a>
                    </div>
                </div>

                {{-- Right Card --}}
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="system-card mx-auto">
                        <div class="card-icon">
                            🔧
                        </div>

                        <h3>Garage Operations</h3>

                        <p>
                            Track repairs, customer records, spare parts, service history,
                            payments, and branch activities with ease.
                        </p>

                        <div class="features">
                            <div class="feature-item">
                                <span>✓</span> Customer Management
                            </div>
                            <div class="feature-item">
                                <span>✓</span> Vehicle Service Records
                            </div>
                            <div class="feature-item">
                                <span>✓</span> Branch-wise Data
                            </div>
                            <div class="feature-item">
                                <span>✓</span> Reports & Invoices
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
<x-footer />
</html>
