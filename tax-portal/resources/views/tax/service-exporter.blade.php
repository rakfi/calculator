@extends('layouts.main')

@section('title','Individual Service Exporters Tax Calculator')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">
                    Service Export Income Tax
                </h5>

                <form method="POST" action="{{ route('tax.service.exporter.calculate') }}">
                    @csrf

                    <label class="form-label">Monthly Export Income (USD)</label>
                    <input type="number"
                           step="0.01"
                           name="monthly_usd"
                           class="form-control mb-3"
                           required>

                    <label class="form-label">USD to LKR Conversion Rate</label>
                    <input type="number"
                           step="0.01"
                           name="conversion_rate"
                           class="form-control mb-3"
                           required>

                    <button class="btn btn-dark w-100">
                        Calculate Tax
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Calculation Method:</strong><br>
                    Monthly USD × Conversion Rate × 12<br>
                    Progressive slab tax applied
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        @if(session('service_export'))
        <div class="col-md-8">

            <!-- SUMMARY -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">Tax Summary</h5>

                <div class="row text-center mt-3">

                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Monthly USD</small>
                            <h6>
                                ${{ number_format(session('service_export.monthly_usd'), 2) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Monthly LKR</small>
                            <h6>
                                LKR {{ number_format(session('service_export.monthly_lkr'), 2) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Annual LKR Income</small>
                            <h6>
                                LKR {{ number_format(session('service_export.annual_lkr'), 2) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Total Annual Tax</small>
                            <h6 class="text-danger">
                                LKR {{ number_format(session('service_export.tax'), 2) }}
                            </h6>
                        </div>
                    </div>

                </div>
            </div>

            <!-- BREAKDOWN -->
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Progressive Tax Breakdown</h6>

                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Income Range</th>
                            <th>Rate</th>
                            <th>Taxable Amount</th>
                            <th>Tax</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('service_export.breakdown') as $row)
                        <tr>
                            <td>{{ $row['range'] }}</td>
                            <td>{{ $row['rate'] }}%</td>
                            <td>LKR {{ number_format($row['taxable'], 2) }}</td>
                            <td>LKR {{ number_format($row['tax'], 2) }}</td>
                        </tr>
                        @endforeach

                        <tr class="fw-bold text-danger">
                            <td colspan="3">Total Tax</td>
                            <td>LKR {{ number_format(session('service_export.tax'), 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- DOWNLOAD PDF -->
<div class="card shadow-sm p-3 mt-3 text-center">
    <a href="{{ route('tax.service.exporter.pdf') }}"
       class="btn btn-outline-dark">
        Download Calculation as PDF
    </a>
</div>
        </div>

        @endif
        

    </div>
</div>
@endsection
