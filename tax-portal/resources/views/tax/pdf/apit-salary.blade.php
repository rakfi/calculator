<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>APIT Salary Tax Report</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        h2 { margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f1f1f1; }
    </style>
</head>
<body>

<h2>APIT / PAYE – Regular Salary Tax Report</h2>
<p><strong>Tax Year:</strong> 2025/26</p>

<p>
    <strong>Monthly Income:</strong> LKR {{ number_format($monthly_income) }} <br>
    <strong>Annual Income:</strong> LKR {{ number_format($annual_income) }} <br>
    <strong>Annual Tax:</strong> LKR {{ number_format($annual_tax) }} <br>
    <strong>Monthly Tax:</strong> LKR {{ number_format($monthly_tax) }}
</p>

<table>
    <thead>
        <tr>
            <th>Rate</th>
            <th>Taxable Amount (LKR)</th>
            <th>Tax (LKR)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($breakdown as $row)
        <tr>
            <td>{{ $row['rate'] }}%</td>
            <td>{{ number_format($row['taxable']) }}</td>
            <td>{{ number_format($row['tax']) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p style="margin-top:20px;">
    <strong>Total Annual Tax:</strong> LKR {{ number_format($annual_tax) }}
</p>

</body>
</html>
