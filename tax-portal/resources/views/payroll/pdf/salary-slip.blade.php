<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salary Slip</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 12px; }
        .table { width: 100%; border-collapse: collapse; }
        .table td, .table th { border: 1px solid #ddd; padding: 8px; }
        .right { text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Salary Slip</h2>
    </div>

    <table class="table">
        <tr>
            <th>Description</th>
            <th class="right">Amount (LKR)</th>
        </tr>
        <tr>
            <td>Basic Salary</td>
            <td class="right">{{ number_format($basic, 2) }}</td>
        </tr>
        <tr>
            <td>Allowances</td>
            <td class="right">{{ number_format($allowances, 2) }}</td>
        </tr>
        <tr>
            <td>Other Payments</td>
            <td class="right">{{ number_format($other, 2) }}</td>
        </tr>
        <tr>
            <th>Gross</th>
            <th class="right">{{ number_format($gross, 2) }}</th>
        </tr>
    </table>

    <br>

    <table class="table">
        <tr>
            <th>Deduction</th>
            <th class="right">Amount (LKR)</th>
        </tr>
        <tr>
            <td>Tax</td>
            <td class="right">{{ number_format($tax, 2) }}</td>
        </tr>
        <tr>
            <th>Total Deductions</th>
            <th class="right">{{ number_format($total_deductions, 2) }}</th>
        </tr>
        <tr>
            <th>Net Pay</th>
            <th class="right">{{ number_format($net, 2) }}</th>
        </tr>
    </table>

</body>
</html>
