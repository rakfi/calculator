@extends('layouts.main')

@section('title', 'VAT Calculator')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">VAT Calculator</h2>

    <div class="row">
        <!-- Input Form -->
        <div class="col-md-4">
            <div class="card p-3 mb-4">
                <form action="{{ route('tax.vat.calculate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="amount" class="form-label">Transaction Amount (LKR)</label>
                        <input type="number" name="amount" id="amount" class="form-control" step="0.01" value="{{ old('amount') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="vat_rate" class="form-label">VAT Rate (%)</label>
                        <input type="number" name="vat_rate" id="vat_rate" class="form-control" step="0.01" value="{{ old('vat_rate', 15) }}" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Calculate VAT</button>
                </form>

                <div class="mt-3 text-muted">
                    <p><strong>Category:</strong> Business Transaction / Services</p>
                    <p><strong>VAT Rate:</strong> {{ old('vat_rate', 15) }}%</p>
                </div>
            </div>
        </div>

        <!-- Result Section -->
        <div class="col-md-8">
            @if(session()->has('vat_amount'))
            <div class="card p-3 mb-4">
                <h5 class="mb-3">VAT Summary</h5>
                <div class="row text-center mb-3">
                    <div class="col">
                        <div class="p-2 bg-light rounded">
                            <small>Transaction Amount</small>
                            <h6>LKR {{ number_format(session('amount'), 2) }}</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-2 bg-light rounded">
                            <small>VAT Amount</small>
                            <h6>LKR {{ number_format(session('vat_amount'), 2) }}</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-2 bg-light rounded">
                            <small>Total Amount</small>
                            <h6>LKR {{ number_format(session('total_amount'), 2) }}</h6>
                        </div>
                    </div>
                </div>

                <h6 class="mt-3">Calculation Details</h6>
                <table class="table table-sm">
                    <tr>
                        <td>Transaction Amount</td>
                        <td>LKR {{ number_format(session('amount'), 2) }}</td>
                    </tr>
                    <tr>
                        <td>VAT Rate</td>
                        <td>{{ session('vat_rate') }}%</td>
                    </tr>
                    <tr>
                        <td>VAT Amount</td>
                        <td>LKR {{ number_format(session('vat_amount'), 2) }}</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td><strong>LKR {{ number_format(session('total_amount'), 2) }}</strong></td>
                    </tr>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
