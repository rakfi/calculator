@extends('layouts.main')

@section('title', 'Salary Slip')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Salary Slip #{{ $slip->id }}</h2>
        <div>
            <a href="{{ route('payroll.saved.download', $slip->id) }}" class="btn btn-dark">Download PDF</a>
            <a href="{{ route('payroll.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    @include('payroll.pdf.salary-slip')

</div>
@endsection
