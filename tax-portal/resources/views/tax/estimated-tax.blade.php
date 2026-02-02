@extends('layouts.main')

@section('title','Estimated Tax Calculation YA 2025/26')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE : INPUT FORM -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">
                    Estimated Tax Calculator<br>
                    <small class="text-muted">YA 2025/26</small>
                </h5>

                <form method="POST" action="{{ route('tax.estimated.calculate') }}">
                    @csrf

                    <!-- INCOME -->
                    <h6 class="fw-bold mt-2">Income Details</h6>

                    <label class="form-label small">Employment Income (LKR)</label>
                    <input type="number" name="employment_income"
                           class="form-control mb-2" value="0">

                    <label class="form-label small">Business / Professional Income</label>
                    <input type="number" name="business_income"
                           class="form-control mb-2" value="0">

                    <label class="form-label small">Rent Income</label>
                    <input type="number" name="rent_income"
                           class="form-control mb-2" value="0">

                    <label class="form-label small">Other Income</label>
                    <input type="number" name="other_income"
                           class="form-control mb-3" value="0">

                    <!-- RELIEFS -->
                    <h6 class="fw-bold">Reliefs / Deductions</h6>

                    <label class="form-label small">EPF / ETF / Approved Provident</label>
                    <input type="number" name="epf"
                           class="form-control mb-2" value="0">

                    <label class="form-label small">Life Insurance</label>
                    <input type="number" name="insurance"
                           class="form-control mb-2" value="0">

                    <label class="form-label small">Medical Insurance</label>
                    <input type="number" name="medical"
                           class="form-control mb-2" value="0">

                    <label class="form-label small">Approved Donations</label>
                    <input type="number" name="donations"
                           class="form-control mb-3" value="0">

                    <button class="btn btn-dark w-100">
                        Calculate Estimated Tax
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Personal Relief:</strong> LKR 1,200,000<br>
                    <strong>Tax System:</strong> Progressive Rates<br>
                    <strong>Applies to:</strong> Individuals
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE : RESULTS -->
        @if(session('estimated_tax'))
        <div class="col-md-8">

            <!-- SUMMARY -->
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">Tax Summary</h5>

                <div class="row text-center mt-3">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Gross Income</small>
                            <h6>
                                LKR {{ number_format(session('gross_income')) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Taxable Income</small>
                            <h6>
                                LKR {{ number_format(session('taxable_income')) }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Total Estimated Tax</small>
                            <h6 class="text-danger">
                                LKR {{ number_format(session('estimated_tax')) }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BREAKDOWN -->
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3">Tax Breakdown (Progressive)</h6>

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
                            <td colspan="2">Total Estimated Tax</td>
                            <td>
                                LKR {{ number_format(session('estimated_tax')) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        @endif

    </div>
</div>
@endsection
