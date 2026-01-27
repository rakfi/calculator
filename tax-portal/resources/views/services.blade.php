@extends('layouts.main')

@section('title', 'Services')

@section('content')

<!-- Services Hero -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Our Services</h1>
        <p class="hero-subtitle">Professional consulting and tax services designed to help your business grow.</p>
    </div>
</section>

<!-- Services Cards -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="section-title">What We Offer</h2>
        <div class="row g-4">
            <!-- Service 1 -->
            <div class="col-md-4">
                <div class="service-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                      <path d="M5 10.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                      <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3-.5V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4h-2a1 1 0 0 1-1-1z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">Tax Consultation</h5>
                    <p>Expert tax planning and compliance solutions for individuals and businesses.</p>
                </div>
            </div>
            <!-- Service 2 -->
            <div class="col-md-4">
                <div class="service-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm11 5l-3 3-2-2-4 4v1h1l4-4 2 2 4-4V5h-1z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">Financial Advisory</h5>
                    <p>Customized financial strategies to maximize growth and reduce risks.</p>
                </div>
            </div>
            <!-- Service 3 -->
            <div class="col-md-4">
                <div class="service-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                      <path d="M6.5 0a.5.5 0 0 0-.5.5V2H3a2 2 0 0 0-2 2v1h14V4a2 2 0 0 0-2-2h-3V.5a.5.5 0 0 0-.5-.5h-4zm0 1h3v1h-3V1z"/>
                      <path d="M0 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H0zm2 1h12v7H2V7z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">Business Consulting</h5>
                    <p>Professional guidance to help your business succeed in competitive markets.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
