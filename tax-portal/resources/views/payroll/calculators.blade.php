@extends('layouts.main')

@section('title', 'Payroll Calculators')

@section('content')

<!-- Hero -->
<section class="hero-section text-center py-5">
    <div class="container">
        <h1 class="hero-title fw-bold">Payroll Calculators</h1>
        <p class="hero-subtitle text-muted">
            Fast, accurate and up-to-date payroll calculators
        </p>
    </div>
</section>

<!-- Calculators -->
<section class="py-5 bg-light">
    <div class="container">

        <h3 class="fw-bold mb-4">Available Calculators</h3>

        <div class="row g-4">

            <!-- Salary Slip Generator -->
             <div class="col-lg-4 col-md-6">
                <div class="tax-card d-flex flex-column h-100">

                    <span class="tax-badge">Payroll</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-file-earmark-person"></i>
                    </div>

                    <h5 class="fw-bold mt-3">
                        Salary Slip Generator
                    </h5>

                    <p class="text-muted">
                        Generate monthly salary slips and downloadable PDFs.
                    </p>

                    <ul class="tax-features">
                        <li>Tax preview and PDF export</li>
                        <li>Simple payroll inputs</li>
                    </ul>

                    <div class="tax-footer mt-auto">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('payroll.form') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

            <!-- Gratuity Calculator -->
             <div class="col-lg-4 col-md-6">
                <div class="tax-card d-flex flex-column h-100">

                    <span class="tax-badge">Compensation</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-calculator"></i>
                    </div>

                    <h5 class="fw-bold mt-3">
                        Gratuity Calculator
                    </h5>

                    <p class="text-muted">
                        Calculate statutory gratuity using configurable months-per-year and caps.
                    </p>

                    <ul class="tax-features">
                        <li>Preview calculation</li>
                        <li>Save results and download PDF</li>
                        <li>Admin settings to change formula</li>
                    </ul>

                    <div class="tax-footer mt-auto">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('gratuity.form') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

            <!-- EPF / ETF Calculator -->
             <div class="col-lg-4 col-md-6">
                <div class="tax-card d-flex flex-column h-100">

                    <span class="tax-badge">Payroll</span>

                    <div class="tax-icon bg-dark">
                        <i class="bi bi-calculator"></i>
                    </div>

                    <h5 class="fw-bold mt-3">
                        EPF / ETF Calculator
                    </h5>

                    <p class="text-muted">
                        Calculate EPF (employee & employer) and ETF contributions.
                    </p>

                    <ul class="tax-features">
                        <li>Current rates from admin settings</li>
                        <li>Instant calculation</li>
                        <li>PDF download</li>
                    </ul>

                    <div class="tax-footer mt-auto">
                        <span>
                            <strong>Tax Year:</strong> 2025/26
                        </span>

                        <a href="{{ route('tax.epf') }}" class="btn btn-dark w-100 mt-3">
                            Start Calculating →
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


@endsection
