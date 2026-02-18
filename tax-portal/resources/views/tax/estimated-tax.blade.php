@extends('layouts.main')

@section('title','Sri Lankan Estimated Tax Calculator')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-5 fw-bold">
        Sri Lankan Estimated Tax Calculator
    </h2>

    <div class="row g-4">

        <!-- ================= INDIVIDUAL SECTION ================= -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Individual Estimated Tax</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tax.estimated.individual') }}">
                        @csrf

                        <h6 class="fw-bold text-primary mb-3">Income Information</h6>

                        <div class="mb-2">
                            <label>Monthly Salary</label>
                            <input type="number" name="salary" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Monthly Business Income</label>
                            <input type="number" name="business_income" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Monthly Rent Income</label>
                            <input type="number" id="rent_income" name="rent_income" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Monthly Other Investment Income</label>
                            <input type="number" name="investment_income" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Monthly Other Income</label>
                            <input type="number" name="other_income" class="form-control">
                        </div>

                        <hr>

                        <h6 class="fw-bold text-success mb-3">Relief & Deductions</h6>

                        <div class="mb-2">
                            <label>Personal Relief (Max: 1,800,000)</label>
                            <input type="number" name="personal_relief" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Solar Panel Relief (Max: 600,000)</label>
                            <input type="number" name="solar_relief" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Approved Charity (Max: 75,000)</label>
                            <input type="number" name="charity" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Other Government Donations</label>
                            <input type="number" name="gov_donation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Rent Relief (25% of Annual Rent Income)</label>
                            <input type="text" id="rent_relief_display" class="form-control bg-light text-success fw-bold" readonly>
                            <input type="hidden" name="rent_relief" id="rent_relief_hidden">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Calculate Individual Tax</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ================= CORPORATE SECTION ================= -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Corporate Estimated Tax</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tax.estimated.corporate') }}">
                        @csrf

                        <h6 class="fw-bold mb-3">Company Income</h6>

                        <div class="mb-3">
                            <label>Monthly Company Profit</label>
                            <input type="number" name="company_profit" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Monthly Other Investment Income</label>
                            <input type="number" name="corp_investment_income" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Monthly Other Income</label>
                            <input type="number" name="corp_other_income" class="form-control">
                        </div>

                        <div class="alert alert-secondary">
                            <strong>Corporate Income Tax:</strong> 30%<br>
                            No relief deductions available
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Calculate Corporate Tax</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= RESULTS ================= -->
    <div class="row mt-5">

        <!-- INDIVIDUAL RESULT -->
        @if(session('estimated_individual_tax'))
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-dark text-white">
                    Individual Tax Result
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p><strong>Total Annual Income:</strong> LKR {{ number_format(session('estimated_individual_tax.annual_income'),2) }}</p>
                        <p><strong>Total Relief:</strong> LKR {{ number_format(session('estimated_individual_tax.total_relief'),2) }}</p>
                        <p><strong>Taxable Income:</strong> LKR {{ number_format(session('estimated_individual_tax.taxable_income'),2) }}</p>
                        <p class="text-danger fw-bold">Total Annual Tax: LKR {{ number_format(session('estimated_individual_tax.total_tax'),2) }}</p>
                    </div>

                    @if(isset(session('estimated_individual_tax')['breakdown']))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Income Range (LKR)</th>
                                    <th>Rate (%)</th>
                                    <th>Taxable Amount</th>
                                    <th>Tax</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('estimated_individual_tax')['breakdown'] as $slab)
                                <tr>
                                    <td>{{ $slab['range'] }}</td>
                                    <td>{{ $slab['rate'] }}</td>
                                    <td>{{ number_format($slab['taxable'],2) }}</td>
                                    <td>{{ number_format($slab['tax'],2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <a href="{{ route('tax.estimated.individual.pdf') }}" class="btn btn-success mt-3 w-100">
                        Download Individual Tax PDF
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- CORPORATE RESULT -->
        @if(session('estimated_corporate_tax'))
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-dark text-white">
                    Corporate Tax Result
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p><strong>Total Annual Profit:</strong> LKR {{ number_format(session('estimated_corporate_tax.annual_income'),2) }}</p>
                        <p class="text-danger fw-bold">Corporate Tax (30%): LKR {{ number_format(session('estimated_corporate_tax.total_tax'),2) }}</p>
                    </div>

                    @if(isset(session('estimated_corporate_tax')['breakdown']))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Income Range (LKR)</th>
                                    <th>Rate (%)</th>
                                    <th>Taxable Amount</th>
                                    <th>Tax</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('estimated_corporate_tax')['breakdown'] as $slab)
                                <tr>
                                    <td>{{ $slab['range'] }}</td>
                                    <td>{{ $slab['rate'] }}</td>
                                    <td>{{ number_format($slab['taxable'],2) }}</td>
                                    <td>{{ number_format($slab['tax'],2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <a href="{{ route('tax.estimated.corporate.pdf') }}" class="btn btn-success mt-3 w-100">
                        Download Corporate Tax PDF
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const rentInput = document.getElementById('rent_income');
    const rentReliefDisplay = document.getElementById('rent_relief_display');
    const rentReliefHidden = document.getElementById('rent_relief_hidden');

    function updateRentRelief() {
        let monthlyRent = parseFloat(rentInput.value) || 0;
        let annualRent = monthlyRent * 12;
        let rentRelief = annualRent * 0.25;

        rentReliefDisplay.value = rentRelief.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        rentReliefHidden.value = rentRelief.toFixed(2);
    }

    rentInput.addEventListener('input', updateRentRelief);
    updateRentRelief();
});
</script>

@endsection
