@extends('layouts.main')

@section('title', 'Tax Calculators')

@section('content')

<!-- Hero -->
<section class="hero-section text-center py-5">
    <div class="container">
        <h1 class="hero-title fw-bold">Tax Calculators</h1>
        <p class="hero-subtitle text-muted">
            Fast, accurate and up-to-date tax calculators for Sri Lanka
        </p>
    </div>
</section>

<!-- Calculators -->
<section class="py-5 bg-light">
    <div class="container">

        <h3 class="fw-bold mb-4">Available Calculators</h3>

        <div class="row g-4">

            <!-- APIT/PAYE Tax on Regular Salary -->
            <div class="col-lg-4 col-md-6">
                <div class="tax-card">

                    <span class="tax-badge">YA 2025/26 Updated</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-person-badge"></i> <!-- Salary / Employee icon -->
                    </div>

                    <h5 class="fw-bold mt-3">
                        APIT/PAYE Tax on Regular Salary
                    </h5>

                    <p class="text-muted">
                        Calculate monthly and annual tax on regular salary using APIT Table 01
                    </p>

                    <ul class="tax-features">
                        <li>Instant calculations</li>
                        <li>Detailed tax breakdown</li>
                        <li>Latest tax rates & regulations (W.E.F. 2025/26)</li>
                    </ul>

                    <div class="tax-footer">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('tax.apit.salary') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

            <!-- APIT Bonus Tax -->
            <div class="col-lg-4 col-md-6">
                <div class="tax-card">

                    <span class="tax-badge">YA 2025/26 Updated</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-cash-stack"></i> <!-- Bonus / Money icon -->
                    </div>

                    <h5 class="fw-bold mt-3">
                        APIT Bonus Tax Calculator
                    </h5>

                    <p class="text-muted">
                        Calculate tax on bonus payments using EGAR Method (APIT Table 02)
                    </p>

                    <ul class="tax-features">
                        <li>Instant calculations</li>
                        <li>Detailed tax breakdown</li>
                        <li>Latest tax rates & regulations (W.E.F. 2025/26)</li>
                    </ul>

                    <div class="tax-footer">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('tax.apit.bonus') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

            <!-- Annual Income Tax Calculator -->
             <div class="col-lg-4 col-md-6">
                <div class="tax-card">

                    <span class="tax-badge">YA 2025/26 Updated</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-calendar2-check"></i> <!-- Annual / Calendar icon -->
                    </div>

                    <h5 class="fw-bold mt-3">
                        Annual Income Tax Calculator
                    </h5>

                    <p class="text-muted">
                        Calculate annual income tax using cumulative gains method (APIT Table 05)
                    </p>

                    <ul class="tax-features">
                        <li>Instant calculations</li>
                        <li>Detailed tax breakdown</li>
                        <li>Latest tax rates & regulations (W.E.F. 2025/26)</li>
                    </ul>

                    <div class="tax-footer">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('tax.annual') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

            <!-- Estimated Tax Calculation YA 2025/26 -->
             <div class="col-lg-4 col-md-6">
                <div class="tax-card">

                    <span class="tax-badge">YA 2025/26 Updated</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-calculator"></i> <!-- Estimation / Calculator icon -->
                    </div>

                    <h5 class="fw-bold mt-3">
                        Estimated Tax Calculation YA 2025/26
                    </h5>

                    <p class="text-muted">
                        Complete income tax with relief system and progressive rates
                    </p>

                    <ul class="tax-features">
                        <li>Instant calculations</li>
                        <li>Detailed tax breakdown</li>
                        <li>Latest tax rates & regulations (W.E.F. 2025/26)</li>
                    </ul>

                    <div class="tax-footer">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('tax.estimated') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

            <!-- Individual Service Exporters -->
             <div class="col-lg-4 col-md-6">
                <div class="tax-card">

                    <span class="tax-badge">YA 2025/26 Updated</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-box-seam"></i> <!-- Export / Package icon -->
                    </div>

                    <h5 class="fw-bold mt-3">
                        Individual Service Exporters
                    </h5>

                    <p class="text-muted">
                        Special tax calculator for export income with preferential rates
                    </p>

                    <ul class="tax-features">
                        <li>Instant calculations</li>
                        <li>Detailed tax breakdown</li>
                        <li>Latest tax rates & regulations (W.E.F. 2025/26)</li>
                    </ul>

                    <div class="tax-footer">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('tax.service.exporter') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

            <!-- VAT Calculator -->
             <div class="col-lg-4 col-md-6">
                <div class="tax-card">

                    <span class="tax-badge">YA 2025/26 Updated</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-receipt"></i> <!-- VAT / Invoice icon -->
                    </div>

                    <h5 class="fw-bold mt-3">
                        VAT Calculator
                    </h5>

                    <p class="text-muted">
                        Calculate Value Added Tax for business transactions and services
                    </p>

                    <ul class="tax-features">
                        <li>Instant calculations</li>
                        <li>Detailed tax breakdown</li>
                        <li>Latest tax rates & regulations (W.E.F. 2025/26)</li>
                    </ul>

                    <div class="tax-footer">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('tax.vat') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


@endsection
