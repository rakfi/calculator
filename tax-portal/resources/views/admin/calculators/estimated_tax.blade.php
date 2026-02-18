@extends('layouts.admin.main')

@section('title','Estimated Tax Rates')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Estimated Tax Rates Management</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- =================== Individual Tax Slabs =================== -->
    <h5 class="fw-bold mt-4 mb-3">Individual Tax Slabs</h5>
    <table class="table table-bordered align-middle table-striped">
        <thead class="table-light">
            <tr>
                <th>Income Range (LKR)</th>
                <th width="120">Rate (%)</th>
                <th width="120">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slabs as $slab)
            <tr>
                <form method="POST" action="{{ url('/admin/calculators/estimated_tax/individual/'.$slab->id) }}">
                    @csrf
                    <td>
                        @if($slab->max_income)
                            {{ number_format($slab->min_income) }} – {{ number_format($slab->max_income) }}
                        @else
                            Above {{ number_format($slab->min_income) }}
                        @endif
                    </td>
                    <td>
                        <input type="number" name="rate" value="{{ $slab->rate }}" class="form-control" min="0" max="100" step="0.01" required>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary w-100">Update</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- =================== Corporate Tax Rate =================== -->
    <h5 class="fw-bold mt-5 mb-3">Corporate Tax Rate</h5>
    <table class="table table-bordered align-middle table-striped">
        <thead class="table-light">
            <tr>
                <th width="120">Rate (%)</th>
                <th width="120">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($corporateRates as $rate)
            <tr>
                <form method="POST" action="{{ url('/admin/calculators/estimated_tax/corporate/'.$rate->id) }}">
                    @csrf
                    <td>
                        <input type="number" name="rate" value="{{ $rate->rate }}" class="form-control" min="0" max="100" step="0.01" required>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary w-100">Update</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
