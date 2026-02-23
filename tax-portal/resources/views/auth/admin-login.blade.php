@extends('layouts.main')

@section('title', 'Admin Login')

@section('content')

<!-- Admin Login Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Admin Dashboard</h1>
        <p class="hero-subtitle">Login to access the admin dashboard and manage settings</p>
    </div>
</section>

<!-- Admin Login Form Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-5 border-0">
                    <div class="alert alert-info mb-4" role="alert">
                        <strong>Admin Access Only</strong><br>
                        <small>This is the admin dashboard login. Please enter your admin credentials.</small>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Login Failed!</strong>
                            @foreach ($errors->all() as $error)
                                <div class="small">{{ $error }}</div>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.store') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', 'admin@gmail.com') }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4 form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label class="form-check-label" for="remember_me">Remember me</label>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 fw-semibold py-2">Admin Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
