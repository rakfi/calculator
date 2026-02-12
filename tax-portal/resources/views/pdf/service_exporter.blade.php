<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Individual Service Exporter Tax</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        td, th {
            border: 1px solid #000;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>

<body>

<h2>
    Individual Service Exporter<br>
    Service Export Income Tax Calculation (YA 2025/26)
</h2>

<table>
    <tr>
        <th>Description</th>
        <th class="text-right">Amount (LKR)</th>
    </tr>

    <tr>
        <td>Gross Service Export Income</td>
        <td class="text-right">
            {{ number_format($data['gross_income'], 2) }}
        </td>
    </tr>

    <tr>
        <td>Allowable Service Export Expenses</td>
        <td class="text-right">
            {{ number_format($data['expenses'], 2) }}
        </td>
    </tr>

    <tr>
        <td><strong>Net Service Export Income</strong></td>
        <td class="text-right">
            <strong>{{ number_format($data['net_income'], 2) }}</strong>
        </td>
    </tr>

    <tr>
        <td><strong>Service Export Tax Payable</strong></td>
        <td class="text-right">
            <strong>{{ number_format($data['tax'], 2) }}</strong>
        </td>
    </tr>
</table>

<div class="footer">
    Generated on {{ now()->format('Y-m-d H:i') }} <br>
    This Service Export Income Tax calculation is for estimation purposes only.
</div>

</body>
</html>
