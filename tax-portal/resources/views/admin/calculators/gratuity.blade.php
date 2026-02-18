@extends('layouts.admin.main')

@section('title', 'Gratuity Settings')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Gratuity Settings</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="post" action="{{ route('admin.gratuity.settings.update') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Months per year</label>
                <input name="months_per_year" type="number" step="0.01" class="form-control" value="{{ $setting->months_per_year ?? 1.0 }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Max months</label>
                <input name="max_months" type="number" class="form-control" value="{{ $setting->max_months ?? 36 }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Use basic only</label>
                <select name="use_basic_only" class="form-select">
                    <option value="1" {{ isset($setting->use_basic_only) && $setting->use_basic_only ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ isset($setting->use_basic_only) && ! $setting->use_basic_only ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="col-12 mt-3">
                <button class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

</div>
@endsection
