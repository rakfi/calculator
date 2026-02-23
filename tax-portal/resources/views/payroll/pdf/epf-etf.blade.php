<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EPF / ETF Calculation</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table td, .table th { border: 1px solid #ddd; padding: 8px; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        .footer { margin-top: 20px; font-size: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>EPF / ETF Contribution Report</h2>
        <p>
            Statutory Contributions under Sri Lanka Law<br>
            EPF (8% Employee, 12% Employer) | ETF (3% Employer)
        </p>
    </div>

    <table class="table">
        <tr>
            <th>Description</th>
            <th class="right">Amount (LKR)</th>
        </tr>

        <tr>
            <td>Monthly Salary</td>
            <td class="right">{{ number_format($monthly_income ?? 0, 2) }}</td>
        </tr>

        <tr>
            <td>EPF - Employee ({{ number_format($employee_rate*100,2) }}%)</td>
            <td class="right">({{ number_format($epf_employee ?? 0, 2) }})</td>
        </tr>

        <tr>
            <td class="bold">Net Salary (After 8% EPF Deduction)</td>
            <td class="right bold">{{ number_format($net_salary ?? 0, 2) }}</td>
        </tr>

        <tr>
            <td>EPF - Employer ({{ number_format($employer_rate*100,2) }}%)</td>
            <td class="right">{{ number_format($epf_employer ?? 0, 2) }}</td>
        </tr>

        <tr>
            <td>ETF - Employer ({{ number_format($etf_rate*100,2) }}%)</td>
            <td class="right">{{ number_format($etf ?? 0, 2) }}</td>
        </tr>

        <tr>
            <td class="bold">Total Employer Contribution (15%)</td>
            <td class="right bold">
                {{ number_format(($epf_employer ?? 0) + ($etf ?? 0), 2) }}
            </td>
        </tr>

        <tr>
            <td class="bold">Total Employer Cost</td>
            <td class="right bold">
                {{ number_format(($monthly_income ?? 0) + ($epf_employer ?? 0) + ($etf ?? 0), 2) }}
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>
            The 
            :contentReference[oaicite:1]{index=1} 
            and 
            :contentReference[oaicite:2]{index=2} 
            are statutory social security schemes established by the Government of Sri Lanka to provide retirement and financial security benefits to employees in the formal sector.
        </p>
    </div>

</body>
</html>