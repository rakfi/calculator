@extends('layouts.main')

@section('title','Annual Income Tax Calculator')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Annual Income Tax</h5>

                <form method="POST" action="{{ route('tax.annual.calculate') }}">
                    @csrf
                    <label class="form-label">Annual Income (LKR)</label>
                    <input type="number" class="form-control mb-3"
                           name="annual_income" required>

                    <button class="btn btn-dark w-100">
                        Calculate Tax
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Tax Year:</strong> 2025/26<br>
                    <strong>Method:</strong> Progressive Rates<br>
                    <strong>Individual Income Tax</strong>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        @if(session()->has('annual_income'))
        <div class="col-md-8">

            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">Tax Summary</h5>

                <div class="row text-center mt-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <small>Annual Income</small>
                            <h6>LKR {{ number_format(session('annual_income')) }}</h6>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <small>Total Tax</small>
                            <h6 class="text-danger">
                                LKR {{ number_format(session('annual_tax')) }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Tax Breakdown</h6>

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Rate</th>
                            <th>Taxable Amount</th>
                            <th>Tax</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('breakdown') as $row)
                        <tr>
                            <td>{{ $row['rate'] }}%</td>
                            <td>LKR {{ number_format($row['taxable']) }}</td>
                            <td>LKR {{ number_format($row['tax']) }}</td>
                        </tr>
                        @endforeach
                        <tr class="fw-bold">
                            <td colspan="2">Total Tax</td>
                            <td>LKR {{ number_format(session('annual_tax')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        @endif

    </div>
</div>
@endsection
