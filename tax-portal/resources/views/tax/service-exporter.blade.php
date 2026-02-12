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

                    <label class="form-label">Annual Export Income (LKR)</label>
                    <input type="number"
                           name="export_income"
                           class="form-control mb-3"
                           required>

                    <label class="form-label">Allowable Expenses (LKR)</label>
                    <input type="number"
                           name="expenses"
                           class="form-control mb-3"
                           value="0">

                    <button class="btn btn-dark w-100">
                        Calculate Tax
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Category:</strong> Individual Service Exporter<br>
                    <strong>Tax Rate:</strong> 15% (Preferential)<br>
                    <strong>Tax Year:</strong> 2025/26
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
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Gross Income</small>
                            <h6>
                                LKR {{ number_format(session('service_export.gross_income')) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Net Taxable Income</small>
                            <h6>
                                LKR {{ number_format(session('service_export.net_income')) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Annual Tax (15%)</small>
                            <h6 class="text-danger">
                                LKR {{ number_format(session('service_export.tax')) }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BREAKDOWN -->
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Tax Calculation Details</h6>

                <table class="table table-sm">
                    <tr>
                        <th>Gross Export Income</th>
                        <td>
                            LKR {{ number_format(session('service_export.gross_income')) }}
                        </td>
                    </tr>
                    <tr>
                        <th>Less: Allowable Expenses</th>
                        <td>
                            LKR {{ number_format(session('service_export.expenses')) }}
                        </td>
                    </tr>
                    <tr class="fw-bold">
                        <th>Net Taxable Income</th>
                        <td>
                            LKR {{ number_format(session('service_export.net_income')) }}
                        </td>
                    </tr>
                    <tr class="fw-bold text-danger">
                        <th>Tax @ 15%</th>
                        <td>
                            LKR {{ number_format(session('service_export.tax')) }}
                        </td>
                    </tr>
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
