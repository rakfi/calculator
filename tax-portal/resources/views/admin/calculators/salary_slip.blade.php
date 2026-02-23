@extends('layouts.admin.main')

@section('title', 'Salary Slip Settings')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Salary Slip Settings</h4>

    <div class="alert alert-info small">
        Configure statutory payroll settings for Sri Lanka salary slip generation.
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.salary_slip.settings.update') }}">
        @csrf

        <div class="row g-3">

            <!-- EPF Rate -->
            <div class="col-md-4">
                <label class="form-label">Employee EPF Rate (%)</label>
                <input type="number"
                       step="0.01"
                       min="0"
                       max="100"
                       name="epf_employee_rate"
                       class="form-control"
                       value="{{ ($setting->epf_employee_rate ?? 0.08) * 100 }}"
                       required>
            </div>

            <!-- APIT Threshold -->
            <div class="col-md-4">
                <label class="form-label">Monthly APIT Threshold (LKR)</label>
                <input type="number"
                       step="0.01"
                       name="monthly_tax_threshold"
                       class="form-control"
                       value="{{ $setting->monthly_tax_threshold ?? 100000 }}"
                       required>
            </div>

            <!-- APIT Rate -->
            <div class="col-md-4">
                <label class="form-label">APIT Rate (%)</label>
                <input type="number"
                       step="0.01"
                       min="0"
                       max="100"
                       name="monthly_tax_rate"
                       class="form-control"
                       value="{{ ($setting->monthly_tax_rate ?? 0.10) * 100 }}"
                       required>
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary">Update Settings</button>
            </div>

        </div>
    </form>

</div>
@endsection