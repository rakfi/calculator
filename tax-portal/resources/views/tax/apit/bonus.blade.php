@extends('layouts.main')

@section('title','APIT / PAYE – Bonus Tax')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Bonus Tax Calculator</h5>

                <form method="POST" action="{{ route('tax.apit.bonus.calculate') }}">
                    @csrf

                    <label class="form-label">Monthly Salary (LKR)</label>
                    <input type="number" class="form-control mb-3"
                           name="monthly_salary" required>

                    <label class="form-label">Bonus Amount (LKR)</label>
                    <input type="number" class="form-control mb-3"
                           name="bonus" required>

                    <button class="btn btn-dark w-100">
                        Calculate Bonus Tax
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Method:</strong> EGAR<br>
                    <strong>Tax Year:</strong> 2025/26<br>
                    <strong>Table:</strong> APIT Table 02
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        @if(session('apit_bonus'))
        <div class="col-md-8">

            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">Bonus Tax Results</h5>

                <div class="row text-center mt-3">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Annual Salary</small>
                            <h6>LKR {{ number_format(session('apit_bonus.annual_salary')) }}</h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Bonus</small>
                            <h6>LKR {{ number_format(session('apit_bonus.bonus')) }}</h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Bonus Tax</small>
                            <h6 class="text-danger">
                                LKR {{ number_format(session('apit_bonus.bonus_tax')) }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">EGAR Calculation Summary</h6>

                <table class="table table-sm">
                    <tr>
                        <th>Tax on Salary Only</th>
                        <td>LKR {{ number_format(session('apit_bonus.tax_without_bonus')) }}</td>
                    </tr>
                    <tr>
                        <th>Tax on Salary + Bonus</th>
                        <td>LKR {{ number_format(session('apit_bonus.tax_with_bonus')) }}</td>
                    </tr>
                    <tr class="fw-bold">
                        <th>Bonus APIT</th>
                        <td>LKR {{ number_format(session('apit_bonus.bonus_tax')) }}</td>
                    </tr>
                </table>
            </div>

        </div>
        @endif

    </div>
</div>
@endsection
