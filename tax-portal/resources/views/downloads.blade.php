@extends('layouts.main')

@section('title', 'Downloads')

@section('content')
<div class="container py-5">
    <h1 class="hero-title fw-bold mb-3">Downloads</h1>
    <p class="text-muted mb-4">Access reports, guides, and reference documents.</p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <h6 class="fw-bold">Tax Guide 2025/26</h6>
                <p class="text-muted">Summary of key tax changes and rates.</p>
                <a href="#" class="btn btn-outline-dark w-100">Download</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <h6 class="fw-bold">Payroll Checklist</h6>
                <p class="text-muted">Monthly payroll compliance checklist.</p>
                <a href="#" class="btn btn-outline-dark w-100">Download</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4 h-100">
                <h6 class="fw-bold">Business Registration</h6>
                <p class="text-muted">Steps and requirements for registration.</p>
                <a href="#" class="btn btn-outline-dark w-100">Download</a>
            </div>
        </div>
    </div>
</div>
@endsection
