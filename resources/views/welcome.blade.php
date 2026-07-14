@extends('layouts.public')

@section('title', 'Welcome to FleeV')

@section('page-content')
    <main class="welcome-wrapper">
        <div class="container">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <div class="brand-badge mb-4">FleeV Garage Management System V1.0.1</div>

                    <h1 class="main-title">Manage Your Garage Smarter with <span>FleeV</span></h1>

                    <p class="main-description">
                        A complete garage management solution for handling customers, vehicles, jobs, invoices,
                        stock, employees, and branch operations from one powerful system.
                    </p>

                    <div class="button-group mt-4">
                        <a href="{{ route('login') }}" class="btn-admin">Log in to FleeV</a>
                    </div>
                </div>

                <div class="col-lg-5 mt-5 mt-lg-0 d-flex justify-content-center justify-content-lg-end">
                    <section class="system-card" aria-labelledby="system-features-title">
                        <div class="card-icon" aria-hidden="true">&#128295;</div>
                        <h3 id="system-features-title">Everything in one place</h3>
                        <p>Sign in once and FleeV will take you to the correct dashboard for your account.</p>

                        <div class="features">
                            @foreach (['Customer Management', 'Vehicle Service Records', 'Branch-wise Data', 'Reports & Invoices'] as $feature)
                                <div class="feature-item"><span aria-hidden="true">&#10003;</span>{{ $feature }}</div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
