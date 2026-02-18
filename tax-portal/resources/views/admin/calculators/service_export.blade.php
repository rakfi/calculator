@extends('layouts.admin.main')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">

    <h4 class="fw-bold mb-4">Edit Service Export Tax Rates</h4>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Annual Limit (LKR)</th>
                <th>Tax Percentage (%)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slabs as $slab)
            <tr>
                <form method="POST"
                      action="{{ url('/admin/calculators/service_export/'.$slab->id) }}">
                    @csrf

                    <td>
                        {{ $slab->income_limit === null
                            ? 'Unlimited'
                            : number_format($slab->income_limit) }}
                    </td>

                    <td>
                        <input type="number"
                               step="0.01"
                               name="percentage"
                               class="form-control"
                               value="{{ $slab->percentage }}"
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
