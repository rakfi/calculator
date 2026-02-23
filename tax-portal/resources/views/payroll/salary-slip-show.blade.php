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

    @php
        // Prepare all fields expected by the PDF view
        $pdfData = [
            'basic' => $slip->basic ?? 0,
            'allowances' => $slip->allowances ?? 0,
            'other' => $slip->other ?? 0,
            'gross' => $slip->gross ?? ($slip->basic + $slip->allowances + $slip->other),
            'epf' => $slip->epf ?? 0,
            'etf' => $slip->etf ?? 0,
            'apit' => $slip->apit ?? 0,
            'total_deductions' => $slip->total_deductions ?? ($slip->epf + $slip->apit),
            'net' => $slip->net ?? (($slip->basic + $slip->allowances + $slip->other) - ($slip->epf + $slip->apit)),
        ];
    @endphp

    @include('payroll.pdf.salary-slip', $pdfData)

</div>
@endsection