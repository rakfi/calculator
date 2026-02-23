<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Gratuity Calculation</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table td, .table th { border: 1px solid #ddd; padding: 8px; }
        .right { text-align: right; }
        .text-center { text-align: center; }
        .eligible { color: green; font-weight: bold; }
        .not-eligible { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Gratuity Calculation Report</h2>
        <p>
            Formula: (Last Monthly Salary ÷ 2) × Completed Years<br>
            Minimum 5 completed years required
        </p>
    </div>

    <table class="table">
        <tr>
            <th>Description</th>
            <th class="right">Value</th>
        </tr>

        <tr>
            <td>Last Drawn Monthly Salary</td>
            <td class="right">LKR {{ number_format($last_month_salary ?? 0, 2) }}</td>
        </tr>

        <tr>
            <td>Completed Years of Service</td>
            <td class="right">{{ intval($service_years ?? 0) }}</td>
        </tr>

        @if(($service_years ?? 0) < 5)
        <tr>
            <td colspan="2" class="text-center not-eligible">
                Employee is NOT eligible (Minimum 5 completed years required)
            </td>
        </tr>
        @else
        <tr>
            <th>Gratuity Amount</th>
            <th class="right eligible">
                LKR {{ number_format($gratuity_amount ?? 0, 2) }}
            </th>
        </tr>
        @endif

    </table>

</body>
</html>