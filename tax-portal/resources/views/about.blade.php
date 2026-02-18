@extends('layouts.main')

@section('title', 'About Us')

@section('content')

<!-- About Hero -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">About SIYENRO</h1>
        <p class="hero-subtitle">We are a trusted consulting firm providing professional advice on taxation, business strategy, and financial planning.</p>
        <a href="{{ route('contact') }}" class="btn btn-dark px-5">Contact Us</a>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                  <path d="M14 14V2H2v12h12zm-1-1H3V3h10v10z"/>
                  <path d="M4 4h1v1H4V4zm2 0h1v1H6V4zm2 0h1v1H8V4zm2 0h1v1h-1V4zM4 6h1v1H4V6zm2 0h1v1H6V6zm2 0h1v1H8V6zm2 0h1v1h-1V6z"/>
                </svg>
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Who We Are</h2>
                <p>SIYENRO provides expert solutions for tax compliance, financial management, and business growth strategies. Our team helps clients achieve success efficiently and professionally.</p>
                <ul class="list-unstyled mt-3">
                    <li>✔ Expert Tax Consulting</li>
                    <li>✔ Financial & Business Advisory</li>
                    <li>✔ Customized Growth Strategies</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
