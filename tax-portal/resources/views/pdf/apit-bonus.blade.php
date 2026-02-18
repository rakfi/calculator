<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>APIT Bonus Tax Calculation</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #000;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .sub-title {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .total {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: center;
        }
    </style>
</head>

<body>

<h2>APIT / PAYE – Bonus Tax Calculation</h2>
<div class="sub-title">
    EGAR Method | Year of Assessment 2025/26
</div>

<table>
    <tr>
        <th>Description</th>
        <th class="text-right">Amount (LKR)</th>
    </tr>

    <tr>
        <td>Annual Salary</td>
        <td class="text-right">{{ number_format($annual_salary, 2) }}</td>
    </tr>

    <tr>
        <td>Bonus Amount</td>
        <td class="text-right">{{ number_format($bonus, 2) }}</td>
    </tr>

    <tr>
        <td>Tax on Salary Only</td>
        <td class="text-right">{{ number_format($tax_without_bonus, 2) }}</td>
    </tr>

    <tr>
        <td>Tax on Salary + Bonus</td>
        <td class="text-right">{{ number_format($tax_with_bonus, 2) }}</td>
    </tr>

    <tr class="total">
        <td>Bonus APIT (Tax on Bonus)</td>
        <td class="text-right">{{ number_format($bonus_tax, 2) }}</td>
    </tr>
</table>

<div class="footer">
    Generated on {{ now()->format('Y-m-d H:i') }} <br>
    This APIT Bonus Tax calculation is for estimation purposes only and does not
    replace official Inland Revenue Department assessments.
</div>

</body>
</html>
