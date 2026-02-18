<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EPF ETF Calculation</title>
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
        <h2>EPF / ETF Calculation</h2>
    </div>

    <table class="table">
        <tr>
            <th>Description</th>
            <th class="right">Amount (LKR)</th>
        </tr>
        <tr>
            <td>Monthly Income</td>
            <td class="right">{{ number_format($monthly_income, 2) }}</td>
        </tr>
        <tr>
            <td>EPF (Employee) — {{ number_format($employee_rate*100,2) }}%</td>
            <td class="right">{{ number_format($epf_employee, 2) }}</td>
        </tr>
        <tr>
            <td>EPF (Employer) — {{ number_format($employer_rate*100,2) }}%</td>
            <td class="right">{{ number_format($epf_employer, 2) }}</td>
        </tr>
        <tr>
            <td>ETF (Employer) — {{ number_format($etf_rate*100,2) }}%</td>
            <td class="right">{{ number_format($etf, 2) }}</td>
        </tr>
        <tr>
            <td>Net Salary</td>
            <td class="right">{{ number_format($net_salary, 2) }}</td>
        </tr>
    </table>

</body>
</html>
