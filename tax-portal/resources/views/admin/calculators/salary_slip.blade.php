@extends('layouts.admin.main')

@section('title', 'Salary Slip Settings')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Salary Slip Settings</h4>

    <div class="alert alert-info small">
        Configure the tax calculation thresholds and rates for salary slip generation.
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.salary_slip.settings.update') }}">
        @csrf

        <div class="row g-3">

            <!-- Monthly Tax Threshold -->
            <div class="col-md-6">
                <label class="form-label">Monthly Tax Threshold (LKR)</label>
                <input type="number"
                       step="0.01"
                       min="0"
                       name="monthly_tax_threshold"
                       class="form-control"
                       value="{{ $setting->monthly_tax_threshold ?? 50000 }}"
                       required>
                <small class="form-text text-muted">Amount above which monthly tax is calculated</small>
            </div>

            <!-- Monthly Tax Rate -->
            <div class="col-md-6">
                <label class="form-label">Monthly Tax Rate (%)</label>
                <input type="number"
                       step="0.01"
                       min="0"
                       max="100"
                       name="monthly_tax_rate"
                       class="form-control"
                       value="{{ ($setting->monthly_tax_rate ?? 0.10) * 100 }}"
                       required>
                <small class="form-text text-muted">Tax rate applied to income above threshold</small>
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary">Update Settings</button>
            </div>

        </div>
    </form>

</div>
@endsection