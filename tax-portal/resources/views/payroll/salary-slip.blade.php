@extends('layouts.main')

@section('title', 'Salary Slip Generator')

@section('content')

<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Salary Slip Generator</h5>

                <form method="post" action="{{ route('payroll.calculate') }}">
                    @csrf

                    <label class="form-label">Basic Salary</label>
                    <input name="basic" type="number" step="0.01" class="form-control mb-3" required>

                    <label class="form-label">Allowances</label>
                    <input name="allowances" type="number" step="0.01" class="form-control mb-3" required>

                    <label class="form-label">Other Payments</label>
                    <input name="other" type="number" step="0.01" class="form-control mb-3" required>

                    <button type="submit" class="btn btn-dark w-100">
                        Calculate
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Calculation:</strong><br>
                    Gross salary, tax, and net pay preview
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        @if(session('salary_slip'))
        @php $d = session('salary_slip'); @endphp
        <div class="col-md-8">

            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">Salary Summary</h5>

                <div class="row text-center mt-3">
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Basic</small>
                            <h6>LKR {{ number_format($d['basic'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Gross</small>
                            <h6>LKR {{ number_format($d['gross'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Tax</small>
                            <h6 class="text-danger">LKR {{ number_format($d['tax'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Net Pay</small>
                            <h6 class="text-success">LKR {{ number_format($d['net'],2) }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Salary Breakdown</h6>
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            <td>Basic Salary</td>
                            <td class="text-end">LKR {{ number_format($d['basic'],2) }}</td>
                        </tr>
                        <tr>
                            <td>Allowances</td>
                            <td class="text-end">LKR {{ number_format($d['allowances'],2) }}</td>
                        </tr>
                        <tr>
                            <td>Other Payments</td>
                            <td class="text-end">LKR {{ number_format($d['other'],2) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Gross Salary</td>
                            <td class="text-end">LKR {{ number_format($d['gross'],2) }}</td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td class="text-end">LKR {{ number_format($d['tax'],2) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Total Deductions</td>
                            <td class="text-end">LKR {{ number_format($d['total_deductions'],2) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Net Pay</td>
                            <td class="text-end">LKR {{ number_format($d['net'],2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card shadow-sm p-3 mt-3 text-center">
                <a href="{{ route('payroll.pdf') }}" class="btn btn-outline-dark">
                    Download Calculation as PDF
                </a>
            </div>

        </div>
        @endif

    </div>
</div>

@endsection
