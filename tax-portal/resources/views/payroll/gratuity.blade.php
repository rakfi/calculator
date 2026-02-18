@extends('layouts.main')

@section('title', 'Gratuity Calculator')

@section('content')

<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Gratuity Calculator</h5>

                <form method="post" action="{{ route('gratuity.calculate') }}">
                    @csrf

                    <label class="form-label">Last Month Salary</label>
                    <input name="last_month_salary" type="number" step="0.01" class="form-control mb-3" required>

                    <label class="form-label">Basic (if applicable)</label>
                    <input name="basic" type="number" step="0.01" class="form-control mb-3" required>

                    <label class="form-label">Years of Service</label>
                    <input name="service_years" type="number" step="0.01" class="form-control mb-3" required>

                    <button type="submit" class="btn btn-dark w-100">
                        Calculate
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Calculation:</strong><br>
                    Service years × months payable × salary base
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        @if(session('gratuity'))
        @php $g = session('gratuity'); @endphp
        <div class="col-md-8">

            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">Gratuity Summary</h5>

                <div class="row text-center mt-3">
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Last Month Salary</small>
                            <h6>LKR {{ number_format($g['last_month_salary'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Service Years</small>
                            <h6>{{ number_format($g['service_years'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Months Payable</small>
                            <h6>{{ number_format($g['months_payable'],2) }}</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded">
                            <small>Gratuity Amount</small>
                            <h6 class="text-success">LKR {{ number_format($g['gratuity_amount'],2) }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Gratuity Breakdown</h6>
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            <td>Last Month Salary</td>
                            <td class="text-end">LKR {{ number_format($g['last_month_salary'],2) }}</td>
                        </tr>
                        <tr>
                            <td>Basic</td>
                            <td class="text-end">LKR {{ number_format($g['basic'],2) }}</td>
                        </tr>
                        <tr>
                            <td>Years of Service</td>
                            <td class="text-end">{{ number_format($g['service_years'],2) }}</td>
                        </tr>
                        <tr>
                            <td>Months Payable</td>
                            <td class="text-end">{{ number_format($g['months_payable'],2) }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>Gratuity Amount</td>
                            <td class="text-end">LKR {{ number_format($g['gratuity_amount'],2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card shadow-sm p-3 mt-3 text-center">
                <a href="{{ route('gratuity.pdf') }}" class="btn btn-outline-dark">
                    Download Calculation as PDF
                </a>
            </div>

        </div>
        @endif

    </div>
</div>

@endsection
