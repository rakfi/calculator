@extends('layouts.main')

@section('title', 'Gratuity Calculation')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gratuity #{{ $item->id }}</h2>
        <div>
            <a href="{{ route('gratuity.saved.download', $item->id) }}" class="btn btn-dark">Download PDF</a>
            <a href="{{ route('gratuity.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    @include('payroll.pdf.gratuity')

</div>
@endsection
