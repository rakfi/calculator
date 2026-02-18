@extends('layouts.main')

@section('title', 'News')

@section('content')

<!-- News Hero -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Latest News</h1>
        <p class="hero-subtitle">Stay updated with our latest insights, updates, and articles.</p>
    </div>
</section>

<!-- News Cards -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="section-title">Recent Articles</h2>
        <div class="row g-4">
            <!-- News 1 -->
            <div class="col-md-4">
                <div class="news-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1h14a.5.5 0 0 1 .5.5V14a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5V1.5zm1 1v11h13V2.5H1z"/>
                      <path d="M2 3h4v1H2V3zm0 2h4v1H2V5zm0 2h4v1H2V7zm0 2h4v1H2v-1z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">Tax Updates 2026</h5>
                    <p>Important changes in tax laws you need to know.</p>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>

            <!-- News 2 -->
            <div class="col-md-4">
                <div class="news-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-lightning" viewBox="0 0 16 16">
                      <path d="M11.3 1L2 8h4l-2 7L14 8h-4l2-7z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">Business Growth Tips</h5>
                    <p>Effective strategies to grow your business in 2026.</p>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>

            <!-- News 3 -->
            <div class="col-md-4">
                <div class="news-card p-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                      <path d="M0 0h1v15H0V0zm3 5h1v10H3V5zm3-2h1v12H6V3zm3 4h1v8H9V7zm3-3h1v11h-1V4z"/>
                    </svg>
                    <h5 class="fw-bold mt-3">Financial Planning</h5>
                    <p>Learn how to plan your finances for long-term success.</p>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
