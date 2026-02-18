<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gratuity Calculation</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table td, .table th { border: 1px solid #ddd; padding: 8px; }
        .right { text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Gratuity Calculation</h2>
    </div>

    <table class="table">
        <tr>
            <th>Description</th>
            <th class="right">Value</th>
        </tr>
        <tr>
            <td>Last Month Salary</td>
            <td class="right">{{ number_format($last_month_salary ?? 0, 2) }}</td>
        </tr>
        <tr>
            <td>Basic</td>
            <td class="right">{{ number_format($basic ?? 0, 2) }}</td>
        </tr>
        <tr>
            <td>Years of Service</td>
            <td class="right">{{ number_format($service_years ?? 0, 2) }}</td>
        </tr>
        <tr>
            <td>Months Payable</td>
            <td class="right">{{ number_format($months_payable ?? 0, 2) }}</td>
        </tr>
        <tr>
            <th>Gratuity Amount</th>
            <th class="right">{{ number_format($gratuity_amount ?? 0, 2) }}</th>
        </tr>
    </table>

</body>
</html>
