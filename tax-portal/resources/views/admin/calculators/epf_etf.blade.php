@extends('layouts.admin.main')

@section('title', 'EPF / ETF Settings')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">EPF / ETF Settings</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="post" action="{{ route('admin.epf.settings.update') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Employee Rate (decimal)</label>
                <input name="employee_rate" type="number" step="0.0001" class="form-control" value="{{ $setting->employee_rate ?? 0.08 }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Employer Rate (decimal)</label>
                <input name="employer_rate" type="number" step="0.0001" class="form-control" value="{{ $setting->employer_rate ?? 0.12 }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">ETF Rate (decimal)</label>
                <input name="etf_rate" type="number" step="0.0001" class="form-control" value="{{ $setting->etf_rate ?? 0.03 }}" required>
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

</div>
@endsection
