@extends('layouts.admin.main')

@section('title','Annual Income Tax Rates')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-4">Annual Income Tax Slabs</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Income Range (LKR)</th>
                <th width="120">Rate (%)</th>
                <th width="160">Deduction (LKR)</th>
                <th width="120">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slabs as $slab)
            <tr>
                <form method="POST"
                      action="{{ url('/admin/calculators/annual_income/'.$slab->id) }}">
                    @csrf

                    <td>
                        @if($slab->max_income)
                            {{ number_format($slab->min_income) }} –
                            {{ number_format($slab->max_income) }}
                        @else
                            Above {{ number_format($slab->min_income) }}
                        @endif
                    </td>

                    <td>
                        <input type="number"
                               name="percentage"
                               value="{{ $slab->percentage }}"
                               class="form-control"
                               min="0"
                               max="100"
                               required>
                    </td>

                    <td>
                        <input type="number"
                               step="0.01"
                               name="deduction"
                               value="{{ $slab->deduction }}"
                               class="form-control"
                               min="0"
                               required>
                    </td>

                    <td>
                        <button class="btn btn-sm btn-primary">
                            Update
                        </button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
