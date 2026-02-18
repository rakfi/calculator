@extends('layouts.main')

@section('title', 'Saved Salary Slips')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Saved Salary Slips</h2>

    @if($slips->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Month</th>
                    <th>Gross</th>
                    <th>Net</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($slips as $slip)
                <tr>
                    <td>{{ $slip->id }}</td>
                    <td>{{ $slip->month }} {{ $slip->year }}</td>
                    <td class="text-end">{{ number_format($slip->gross, 2) }}</td>
                    <td class="text-end">{{ number_format($slip->net, 2) }}</td>
                    <td>{{ $slip->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('payroll.show', $slip->id) }}" class="btn btn-sm btn-outline-dark">View</a>
                        <a href="{{ route('payroll.saved.download', $slip->id) }}" class="btn btn-sm btn-dark">Download PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $slips->links() }}
    @else
        <p class="text-muted">No salary slips saved yet.</p>
    @endif

</div>
@endsection
