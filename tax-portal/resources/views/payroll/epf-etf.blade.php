@extends('layouts.main')

@section('title', 'EPF / ETF Calculator')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">EPF/ETF Calculator</h5>

                <form method="post" action="{{ route('tax.epf.calculate') }}">
                    @csrf

                    <label class="form-label">Monthly Income (LKR)</label>
                    <input name="monthly_income" type="number" step="0.01" class="form-control mb-3" required>

                    <button class="btn btn-dark w-100" type="submit">
                        Calculate
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>EPF Calculator Effective from 2025</strong><br>
                    Employee EPF 8%, Employer EPF 12%, ETF 3%<br>
                    Net salary after EPF: 92%
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        @if(session('epf_etf'))
        @php $e = session('epf_etf'); @endphp
        <div class="col-md-8">

            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">EPF/ETF Summary</h5>

                <div class="row text-center mt-3">
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Monthly Income</small>
                            <h6>LKR {{ number_format($e['monthly_income'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>EPF (Employee)</small>
                            <h6>LKR {{ number_format($e['epf_employee'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>EPF (Employer)</small>
                            <h6>LKR {{ number_format($e['epf_employer'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>ETF (Employer)</small>
                            <h6>LKR {{ number_format($e['etf'],2) }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">EPF/ETF Breakdown</h6>
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            <td>Monthly Income</td>
                            <td class="text-end">LKR {{ number_format($e['monthly_income'],2) }}</td>
                        </tr>
                        <tr>
                            <td>EPF (Employee) — {{ number_format($e['employee_rate']*100,2) }}%</td>
                            <td class="text-end">LKR {{ number_format($e['epf_employee'],2) }}</td>
                        </tr>
                        <tr>
                            <td>EPF (Employer) — {{ number_format($e['employer_rate']*100,2) }}%</td>
                            <td class="text-end">LKR {{ number_format($e['epf_employer'],2) }}</td>
                        </tr>
                        <tr>
                            <td>ETF (Employer) — {{ number_format($e['etf_rate']*100,2) }}%</td>
                            <td class="text-end">LKR {{ number_format($e['etf'],2) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Net Salary</td>
                            <td class="text-end">LKR {{ number_format($e['net_salary'],2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card shadow-sm p-3 mt-3 text-center">
                <a href="{{ route('tax.epf.pdf') }}" class="btn btn-outline-dark">
                    Download Calculation as PDF
                </a>
            </div>

        </div>
        @endif

    </div>
</div>
@endsection
