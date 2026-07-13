<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login' }} - FleeV</title>
    <x-theme-head />

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ global_asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ global_asset('css/components.css') }}">
</head>

<body>
    <x-theme-toggle />

    <main class="login-wrapper">
        <div class="container">
            <div class="row min-vh-100 align-items-center justify-content-center">

                <div class="col-lg-5 col-md-8 col-sm-10">
                    <div class="login-card">

                        <div class="login-header text-center">
                            <div class="logo-box">
                                🔧
                            </div>

                            <h1>FleeV</h1>

                            <h2>{{ $title ?? 'Login' }}</h2>

                            <p>
                                {{ $subtitle ?? 'Login to continue to FleeV.' }}
                            </p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ $formAction ?? url('/login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email Address
                                </label>

                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="Enter your email" required autofocus>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password" required>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>

                                <a href="#" class="forgot-link">
                                    Forgot password?
                                </a>
                            </div>

                            <button type="submit" class="btn login-btn w-100">
                                Login
                            </button>
                        </form>

                        <div class="login-footer text-center">
                            <a href="{{ url('/') }}">
                                Back to Home
                            </a>
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
