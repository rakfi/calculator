@extends('layouts.main')

@section('title', 'Personal Income Tax Calculator')

@section('content')

<!-- Hero Header -->
<section class="py-5 text-white text-center" 
         style="background: linear-gradient(135deg, #343a40, #6c757d);">
    <div class="container">
        <h1 class="fw-bold mb-2">Personal Income Tax Calculator</h1>
        <p class="mb-0 opacity-75">Sri Lanka · Fast · Accurate · Simple</p>
    </div>
</section>

<section class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <!-- Calculator Card -->
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    <h4 class="fw-bold text-center mb-4">
                        💰 Enter Your Annual Income
                    </h4>

                    <form method="POST" action="{{ route('tax.personal.calculate') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Annual Income (LKR)
                            </label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">
                                    Rs.
                                </span>
                                <input type="number"
                                       name="annual_income"
                                       class="form-control"
                                       placeholder="e.g. 2500000"
                                       required
                                       value="{{ old('annual_income') }}">
                            </div>
                        </div>

                        <button class="btn btn-dark btn-lg w-100 rounded-pill">
                            Calculate Tax
                        </button>
                    </form>

                </div>
            </div>

            <!-- Results -->
            @if(session('annual_income') !== null)
                <div class="card border-0 shadow-sm mt-4 rounded-4">
                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3 text-center">
                            📊 Tax Calculation Summary
                        </h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Annual Income</span>
                            <span class="fw-semibold">
                                LKR {{ number_format(session('annual_income'), 2) }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Taxable Income</span>
                            <span class="fw-semibold">
                                LKR {{ number_format(session('taxable_income'), 2) }}
                            </span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-danger">
                                Annual Tax Payable
                            </span>
                            <span class="fw-bold text-danger fs-5">
                                LKR {{ number_format(session('tax'), 2) }}
                            </span>
                        </div>

                        <div class="text-muted text-center mt-3">
                            Monthly Tax ≈
                            <strong>
                                LKR {{ number_format(session('tax') / 12, 2) }}
                            </strong>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>

</section>

@endsection
