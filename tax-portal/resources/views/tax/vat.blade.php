@extends('layouts.main')

@section('title', 'VAT / GST Calculator')

@section('content')

<!-- Hero -->
<section class="py-5 text-white text-center"
         style="background: linear-gradient(135deg, #343a40, #6c757d);">
    <div class="container">
        <h1 class="fw-bold mb-2">VAT / GST Calculator</h1>
        <p class="mb-0 opacity-75">Sri Lanka · Standard VAT 18%</p>
    </div>
</section>

<section class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <!-- Calculator Card -->
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    <h4 class="fw-bold text-center mb-4">
                        🧾 VAT Calculation
                    </h4>

                    <form method="POST" action="{{ route('tax.vat.calculate') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Amount (LKR)
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">Rs.</span>
                                <input type="number"
                                       name="amount"
                                       class="form-control"
                                       placeholder="e.g. 100,000"
                                       required
                                       value="{{ old('amount') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Amount Type
                            </label>
                            <select name="vat_type" class="form-select form-select-lg" required>
                                <option value="exclusive">
                                    VAT Exclusive (Add VAT)
                                </option>
                                <option value="inclusive">
                                    VAT Inclusive (Extract VAT)
                                </option>
                            </select>
                        </div>

                        <button class="btn btn-dark btn-lg w-100 rounded-pill">
                            Calculate VAT
                        </button>
                    </form>

                </div>
            </div>

            <!-- Results -->
            @if(session('amount') !== null)
                <div class="card border-0 shadow-sm mt-4 rounded-4">
                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3 text-center">
                            📊 VAT Summary
                        </h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Net Amount</span>
                            <span class="fw-semibold">
                                LKR {{ number_format(session('net'), 2) }}
                            </span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>VAT ({{ session('rate') }}%)</span>
                            <span class="fw-semibold text-danger">
                                LKR {{ number_format(session('vat'), 2) }}
                            </span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total Amount</span>
                            <span class="fw-bold fs-5 text-success">
                                LKR {{ number_format(session('total'), 2) }}
                            </span>
                        </div>

                    </div>
                </div>
            @endif

        </div>
    </div>

</section>

@endsection
