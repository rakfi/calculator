@extends('layouts.main')

@section('title', 'Salary Slip Generator')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE: FORM -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Salary Slip Generator</h5>

                <form method="post" action="{{ route('payroll.calculate') }}">
                    @csrf

                    <label class="form-label">Employee Name</label>
                    <input name="employee_name" type="text" class="form-control mb-3" required>

                    <label class="form-label">Designation</label>
                    <input name="designation" type="text" class="form-control mb-3" required>

                    <label class="form-label">NIC Number</label>
                    <input name="nic" type="text" class="form-control mb-3" required>

                    <label class="form-label">EPF Number</label>
                    <input name="epf_no" type="text" class="form-control mb-3" required>

                    <label class="form-label">Salary Month</label>
                    <select name="month" class="form-select mb-3" required>
                        @foreach([
                            'January','February','March','April','May','June',
                            'July','August','September','October','November','December'
                        ] as $m)
                            <option value="{{ $m }}">{{ $m }}</option>
                        @endforeach
                    </select>

                    <hr>

                    <label class="form-label">Basic Salary</label>
                    <input name="basic" type="number" step="0.01" class="form-control mb-3" required>

                    <label class="form-label">Allowances</label>
                    <input name="allowances" type="number" step="0.01" class="form-control mb-3" value="0">

                    <label class="form-label">Other Payments</label>
                    <input name="other" type="number" step="0.01" class="form-control mb-3" value="0">

                    <button type="submit" class="btn btn-dark w-100">Generate Salary Slip</button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Includes:</strong> EPF (8%), ETF (3%), APIT, Net Salary
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: PREVIEW -->
        @php $d = session('salary_slip') @endphp
        @if($d && is_array($d))
        <div class="col-md-8">
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">
                    Salary Summary for {{ $d['employee_name'] ?? '' }} - {{ $d['month'] ?? '' }}
                </h5>
                <div class="row text-center mt-3">
                    <div class="col-md-3">
                        <small>Gross Salary</small>
                        <h6>LKR {{ number_format($d['gross'] ?? 0,2) }}</h6>
                    </div>
                    <div class="col-md-3">
                        <small>EPF (8%)</small>
                        <h6 class="text-danger">LKR {{ number_format($d['epf_employee'] ?? 0,2) }}</h6>
                    </div>
                    <div class="col-md-3">
                        <small>APIT</small>
                        <h6 class="text-danger">LKR {{ number_format($d['apit'] ?? 0,2) }}</h6>
                    </div>
                    <div class="col-md-3">
                        <small>Net Salary</small>
                        <h6 class="text-success">LKR {{ number_format($d['net'] ?? 0,2) }}</h6>
                    </div>
                </div>
            </div>

            <!-- BREAKDOWN -->
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Salary Breakdown</h6>
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr><td>Basic Salary</td><td class="text-end">LKR {{ number_format($d['basic'] ?? 0,2) }}</td></tr>
                        <tr><td>Allowances</td><td class="text-end">LKR {{ number_format($d['allowances'] ?? 0,2) }}</td></tr>
                        <tr><td>Other Payments</td><td class="text-end">LKR {{ number_format($d['other'] ?? 0,2) }}</td></tr>
                        <tr class="fw-bold"><td>Gross Salary</td><td class="text-end">LKR {{ number_format($d['gross'] ?? 0,2) }}</td></tr>
                        <tr><td>EPF (Employee 8%)</td><td class="text-end">LKR {{ number_format($d['epf_employee'] ?? 0,2) }}</td></tr>
                        <tr><td>APIT</td><td class="text-end">LKR {{ number_format($d['apit'] ?? 0,2) }}</td></tr>
                        <tr class="fw-bold"><td>Total Deductions</td><td class="text-end">LKR {{ number_format($d['total_deductions'] ?? 0,2) }}</td></tr>
                        <tr class="fw-bold"><td>Net Salary</td><td class="text-end text-success">LKR {{ number_format($d['net'] ?? 0,2) }}</td></tr>
                        <tr><td>ETF (Employer 3%)</td><td class="text-end text-muted">LKR {{ number_format($d['etf_employer'] ?? 0,2) }}</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="card shadow-sm p-3 mt-3 text-center">
                <a href="{{ route('payroll.pdf') }}" class="btn btn-outline-dark">Download Salary Slip PDF</a>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection