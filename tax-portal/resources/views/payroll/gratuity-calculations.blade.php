@extends('layouts.main')

@section('title', 'Saved Gratuity Calculations')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Saved Gratuity Calculations</h2>

    @if($items->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Month</th>
                    <th>Years</th>
                    <th>Months Payable</th>
                    <th>Amount</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $it)
                <tr>
                    <td>{{ $it->id }}</td>
                    <td>{{ $it->month }} {{ $it->year }}</td>
                    <td>{{ number_format($it->service_years,2) }}</td>
                    <td class="text-end">{{ number_format($it->months_payable,2) }}</td>
                    <td class="text-end">{{ number_format($it->gratuity_amount,2) }}</td>
                    <td>{{ $it->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('gratuity.show', $it->id) }}" class="btn btn-sm btn-outline-dark">View</a>
                        <a href="{{ route('gratuity.saved.download', $it->id) }}" class="btn btn-sm btn-dark">Download PDF</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $items->links() }}
    @else
        <p class="text-muted">No gratuity calculations saved yet.</p>
    @endif

</div>
@endsection
