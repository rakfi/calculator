@extends('layouts.admin.main')

@section('title', 'EPF / ETF Settings')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">EPF / ETF Settings</h4>

    <div class="alert alert-info small">
        Standard statutory rates in Sri Lanka:
        Employee EPF 8% | Employer EPF 12% | Employer ETF 3%
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="post" action="{{ route('admin.epf.settings.update') }}">
        @csrf

        <div class="row g-3">

            <div class="col-md-4">
                <label class="form-label">Employee EPF Rate (%)</label>
                <input name="employee_rate"
                       type="number"
                       step="0.01"
                       min="0"
                       max="100"
                       class="form-control"
                       value="{{ ($setting->employee_rate ?? 0.08) * 100 }}"
                       required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Employer EPF Rate (%)</label>
                <input name="employer_rate"
                       type="number"
                       step="0.01"
                       min="0"
                       max="100"
                       class="form-control"
                       value="{{ ($setting->employer_rate ?? 0.12) * 100 }}"
                       required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Employer ETF Rate (%)</label>
                <input name="etf_rate"
                       type="number"
                       step="0.01"
                       min="0"
                       max="100"
                       class="form-control"
                       value="{{ ($setting->etf_rate ?? 0.03) * 100 }}"
                       required>
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary">Update Settings</button>
            </div>

        </div>
    </form>

</div>
@endsection