@extends('layouts.main')

@section('title', 'Gratuity Calculator')

@section('content')

<div class="container py-5">
    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Gratuity Calculator</h5>

                <form method="post" action="{{ route('gratuity.calculate') }}">
                    @csrf

                    <label class="form-label">Last Drawn Monthly Salary</label>
                    <input name="last_month_salary" type="number" step="0.01" class="form-control mb-3" required>

                    <label class="form-label">Completed Years of Service</label>
                    <input name="service_years" type="number" min="0" step="1" class="form-control mb-3" required>

                    <button type="submit" class="btn btn-dark w-100">
                        Calculate
                    </button>
                </form>

                <div class="alert alert-light mt-4 small">
                    <strong>Calculation Formula:</strong><br>
                    (Last Monthly Salary ÷ 2) × Completed Years<br>
                    <span class="text-danger">Minimum 5 completed years required.</span>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        @if(session('gratuity'))
        @php $g = session('gratuity'); @endphp
        <div class="col-md-8">

            <div class="card shadow-sm p-4 mb-4">
                <h5 class="fw-bold">Gratuity Summary</h5>

                @if($g['service_years'] < 5)
                    <div class="alert alert-danger mt-3">
                        Employee is not eligible. Minimum 5 completed years required.
                    </div>
                @else
                <div class="row text-center mt-3">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Last Monthly Salary</small>
                            <h6>LKR {{ number_format($g['last_month_salary'],2) }}</h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Completed Years</small>
                            <h6>{{ $g['service_years'] }}</h6>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded">
                            <small>Gratuity Amount</small>
                            <h6 class="text-success">
                                LKR {{ number_format($g['gratuity_amount'],2) }}
                            </h6>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if($g['service_years'] >= 5)
            <div class="card shadow-sm p-3 mt-3 text-center">
                <a href="{{ route('gratuity.pdf') }}" class="btn btn-outline-dark">
                    Download Calculation as PDF
                </a>
            </div>
            @endif

        </div>
        @endif

    </div>
</div>

@endsection