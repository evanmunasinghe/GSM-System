<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Portal - GMS</title>
    <x-theme-head />

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/branch-portal.css') }}">
    <link rel="stylesheet" href="{{ global_asset('css/components.css') }}">
</head>
<body>
    <x-theme-toggle />

    <main class="branch-wrapper">
        <div class="container">
            <div class="row min-vh-100 align-items-center justify-content-center">

                <div class="col-lg-5 col-md-8 col-sm-10">
                    <div class="branch-card">

                        <div class="branch-header text-center">
                            <div class="logo-box">
                                🏢
                            </div>

                            <h1>Branch Portal</h1>

                            <p>
                                Enter your branch code to continue to your branch login page.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('branch.portal.redirect') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="branch" class="form-label">
                                    Branch Code
                                </label>

                                <input
                                    type="text"
                                    name="branch"
                                    id="branch"
                                    class="form-control @error('branch') is-invalid @enderror"
                                    value="{{ old('branch') }}"
                                    placeholder="Example: davesautos"
                                    required
                                    autofocus
                                >

                                @error('branch')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="help-text">
                                    Example: enter <strong>davesautos</strong> for davesautos.localhost
                                </small>
                            </div>

                            <button type="submit" class="btn continue-btn w-100">
                                Continue to Branch Login
                            </button>
                        </form>

                        <div class="branch-footer text-center">
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
