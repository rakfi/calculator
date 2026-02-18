<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Individual Tax Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; line-height: 1.5; }
        h2 { text-align: center; color: #1E90FF; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #1E90FF; color: #fff; }
        .summary { margin-top: 20px; }
        .summary p { font-size: 16px; }
        .total { font-size: 18px; color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Individual Estimated Tax Report</h2>

    <div class="summary">
        <p><strong>Total Annual Income:</strong> LKR {{ number_format($data['annual_income'], 2) }}</p>
        <p><strong>Total Relief:</strong> LKR {{ number_format($data['total_relief'], 2) }}</p>
        <p><strong>Taxable Income:</strong> LKR {{ number_format($data['taxable_income'], 2) }}</p>
        <p class="total">Total Annual Tax: LKR {{ number_format($data['total_tax'], 2) }}</p>
    </div>

    @if(isset($data['breakdown']) && count($data['breakdown']))
    <h3>Tax Slab Breakdown</h3>
    <table>
        <thead>
            <tr>
                <th>Income Range (LKR)</th>
                <th>Rate (%)</th>
                <th>Taxable Amount</th>
                <th>Tax</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['breakdown'] as $slab)
            <tr>
                <td>{{ $slab['range'] }}</td>
                <td>{{ $slab['rate'] }}</td>
                <td>{{ number_format($slab['taxable'], 2) }}</td>
                <td>{{ number_format($slab['tax'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</body>
</html>
