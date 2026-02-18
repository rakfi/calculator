@extends('layouts.main')

@section('title', 'VAT Calculator')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">VAT Calculator</h2>

    <div class="row">
        <!-- Input Form -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4 mb-4">
                <form action="{{ route('tax.vat.calculate') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="amount" class="form-label">
                            Transaction Amount (LKR)
                        </label>
                        <input type="number"
                               name="amount"
                               id="amount"
                               class="form-control"
                               step="0.01"
                               value="{{ old('amount') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="vat_rate" class="form-label">
                            VAT Rate (%)
                        </label>
                        <input type="number"
                               name="vat_rate"
                               id="vat_rate"
                               class="form-control"
                               step="0.01"
                               value="{{ old('vat_rate', 15) }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        Calculate VAT
                    </button>
                </form>

                <div class="mt-3 text-muted small">
                    <p><strong>Category:</strong> Business Transaction / Services</p>
                    <p><strong>Default VAT Rate:</strong> 15%</p>
                </div>
            </div>
        </div>

        <!-- Result Section -->
        <div class="col-md-8">
            @if(session()->has('vat_calculation'))
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="mb-4 fw-bold">VAT Summary</h5>

                <div class="row text-center mb-4">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Transaction Amount</small>
                            <h6 class="fw-bold">
                                LKR {{ number_format(session('vat_calculation.amount'), 2) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>VAT Amount</small>
                            <h6 class="fw-bold text-danger">
                                LKR {{ number_format(session('vat_calculation.vat_amount'), 2) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Total Amount</small>
                            <h6 class="fw-bold text-success">
                                LKR {{ number_format(session('vat_calculation.total_amount'), 2) }}
                            </h6>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold">Calculation Details</h6>

                <div class="table-responsive">
                    <table class="table table-sm table-bordered align-middle">
                        <tbody>
                            <tr>
                                <td>Transaction Amount</td>
                                <td>
                                    LKR {{ number_format(session('vat_calculation.amount'), 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>VAT Rate</td>
                                <td>
                                    {{ session('vat_calculation.vat_rate') }}%
                                </td>
                            </tr>
                            <tr>
                                <td>VAT Amount</td>
                                <td>
                                    LKR {{ number_format(session('vat_calculation.vat_amount'), 2) }}
                                </td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total Amount</td>
                                <td>
                                    LKR {{ number_format(session('vat_calculation.total_amount'), 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- OPTIONAL: PDF BUTTON -->
            <div class="card shadow-sm p-3 text-center">
                <a href="{{ route('tax.vat.pdf') }}"
                   class="btn btn-outline-dark px-4">
                    Download VAT Report (PDF)
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
