@extends('layouts.main')

@section('title', 'Gratuity Settings')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Gratuity Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="post" action="{{ route('admin.gratuity.settings.update') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Months per year</label>
                <input name="months_per_year" type="number" step="0.01" class="form-control" value="{{ $setting->months_per_year ?? 1.0 }}" />
            </div>

            <div class="col-md-4">
                <label class="form-label">Max months</label>
                <input name="max_months" type="number" class="form-control" value="{{ $setting->max_months ?? 36 }}" />
            </div>

            <div class="col-md-4">
                <label class="form-check-label d-block">Use basic only</label>
                <input name="use_basic_only" type="checkbox" class="form-check-input" value="1" {{ isset($setting->use_basic_only) && $setting->use_basic_only ? 'checked' : '' }} />
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-dark">Save Settings</button>
            </div>
        </div>
    </form>
</div>
@endsection
