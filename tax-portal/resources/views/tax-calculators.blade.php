@extends('layouts.main')

@section('title', 'Tax Calculators')

@section('content')

<!-- Tax Calculators Hero -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Tax Calculators</h1>
        <p class="hero-subtitle">Easily calculate taxes for your business and personal finances.</p>
    </div>
</section>

<!-- Calculators Cards -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="section-title">Available Calculators</h2>
        <div class="row g-4 justify-content-center">
            <!-- Personal Income Tax -->
            <div class="col-md-4">
                <div class="service-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                      <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H3zm1 2h8v2H4V2zm1 4h1v1H5V6zm2 0h1v1H7V6zm2 0h1v1H9V6zm-2 2h1v1H7V8zm2 0h1v1H9V8zm-4 2h1v1H5v-1zm2 0h1v1H7v-1zm2 0h1v1H9v-1zm-4 2h1v1H5v-1zm2 0h1v1H7v-1z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">Personal Income Tax</h5>
                    <p>Calculate your personal income tax easily.</p>
                    <a href="{{ route('tax.personal') }}" class="stretched-link"></a>

                </div>
            </div>

            <!-- Business Tax -->
            <div class="col-md-4">
                <div class="service-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                      <path d="M0 0h1v15H0V0zm3 5h1v10H3V5zm3-2h1v12H6V3zm3 4h1v8H9V7zm3-3h1v11h-1V4z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">Business Tax</h5>
                    <p>Determine your business tax obligations quickly.</p>
                    <a href="{{ route('tax.business') }}" class="stretched-link"></a>
                </div>
            </div>

            <!-- VAT / GST -->
            <div class="col-md-4">
                <div class="service-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                      <path d="M1.92.506a.5.5 0 0 1 .448-.506h11.264a.5.5 0 0 1 .448.506l-1.112 14.02a.5.5 0 0 1-.448.474H3.48a.5.5 0 0 1-.448-.474L1.92.506zM2 1v13h12V1H2zm2 2h8v1H4V3zm0 2h8v1H4V5zm0 2h8v1H4V7zm0 2h8v1H4V9z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">VAT / GST Calculator</h5>
                    <p>Compute VAT or GST quickly for products/services.</p>
                    <a href="{{ route('tax.vat') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
