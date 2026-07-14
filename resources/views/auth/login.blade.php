@extends('layouts.public')

@section('title', 'Login | FleeV')

@section('page-content')
    <main class="login-wrapper d-flex align-items-center py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="login-card">
                        <div class="login-header text-center">
                            <div class="logo-box" aria-hidden="true">&#128295;</div>
                            <h1>FleeV</h1>
                            <h2>Welcome back</h2>
                            <p>Use your FleeV credentials. Your account will open the correct dashboard.</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        @endif

                        @if (! empty($credentials))
                            @foreach ($credentials as $credential)
                                <div class="demo-credentials">
                                    <div>
                                        <strong>{{ $credential['label'] }}</strong>
                                        <span>{{ $credential['email'] }}</span>
                                    </div>
                                    <button
                                        type="button"
                                        data-demo-credentials
                                        data-email="{{ $credential['email'] }}"
                                        data-password="{{ $credential['password'] }}"
                                    >
                                        Use account
                                    </button>
                                </div>
                            @endforeach
                        @endif

                        <form method="POST" action="{{ route('login.store') }}" data-submit-form>
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="Enter your email"
                                    required
                                    autofocus
                                    autocomplete="email"
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-4">
                                <input type="hidden" name="remember" value="0">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                    value="1"
                                    @checked(old('remember'))
                                >
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="btn login-btn w-100" data-submitting-text="Logging in...">
                                Login
                            </button>
                        </form>

                        <div class="login-footer text-center">
                            <a href="{{ route('home') }}">&larr; Back to welcome page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
