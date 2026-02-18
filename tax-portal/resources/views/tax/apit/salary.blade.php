@extends('layouts.main')

@section('title','APIT / PAYE – Regular Salary')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Calculate Your Monthly Tax</h5>

                <form method="POST" action="{{ route('tax.apit.salary.calculate') }}">
                    @csrf

                    <label class="form-label">Monthly Income (LKR)</label>
                    <input type="number" class="form-control mb-3"
                           name="monthly_income" required>

                    <button class="btn btn-dark w-100">
                        Calculate Tax
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Tax Type:</strong> APIT / PAYE<br>
                    <strong>Tax Year:</strong> 2025/26<br>
                    <strong>Table:</strong> APIT Table 01
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
       @if(session('apit_salary'))

        <div class="col-md-8">

            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">Tax Calculation Results</h5>

                <div class="row text-center mt-3">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Annual Income</small>
                            <h6>LKR {{ number_format(session('apit_salary.annual_income')) }}</h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Annual Tax</small>
                            <h6 class="text-danger">
                                LKR {{ number_format(session('apit_salary.annual_tax')) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Monthly Tax</small>
                            <h6 class="text-success">
                                LKR {{ number_format(session('apit_salary.monthly_tax')) }}
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
                        @foreach(session('apit_salary.breakdown') as $row)
                        <tr>
                            <td>{{ $row['rate'] }}%</td>
                            <td>LKR {{ number_format($row['taxable']) }}</td>
                            <td>LKR {{ number_format($row['tax']) }}</td>
                        </tr>
                        @endforeach
                        <tr class="fw-bold">
                            <td colspan="2">Total Annual Tax</td>
                            <td>LKR {{ number_format(session('apit_salary.annual_tax')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- DOWNLOAD PDF -->
            <div class="card shadow-sm p-3 mt-3 text-center">
                <a href="{{ route('tax.apit.salary.pdf') }}"
                   class="btn btn-outline-dark">
                    Download Calculation as PDF
                </a>
            </div>


        </div>
        @endif

    </div>
</div>
@endsection
