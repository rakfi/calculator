@extends('layouts.admin.main')

@section('title', 'Salary Slip Settings')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Salary Slip Settings</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.salary_slip.settings.update') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Monthly Tax Threshold (LKR)</label>
                <input type="number" step="0.01" name="monthly_tax_threshold" class="form-control" value="{{ $setting->monthly_tax_threshold ?? 50000 }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Monthly Tax Rate (decimal)</label>
                <input type="number" step="0.0001" name="monthly_tax_rate" class="form-control" value="{{ $setting->monthly_tax_rate ?? 0.10 }}" required>
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

</div>
@endsection
