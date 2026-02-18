@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Login</h5>

                <form method="post" action="#">
                    @csrf

                    <label class="form-label">Email</label>
                    <input type="email" class="form-control mb-3" placeholder="you@example.com" required>

                    <label class="form-label">Password</label>
                    <input type="password" class="form-control mb-3" placeholder="••••••••" required>

                    <button type="submit" class="btn btn-dark w-100">Sign In</button>
                </form>

                <div class="mt-3 text-muted small">
                    This is a placeholder login page.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
