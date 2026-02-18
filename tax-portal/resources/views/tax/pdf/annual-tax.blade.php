<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Annual Income Tax Report 2025/26</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 6px;
        }

        .summary-box {
            background: #f4f4f4;
            padding: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: right;
        }

        table th {
            background: #f0f0f0;
        }

        .text-left {
            text-align: left;
        }

        .total-row {
            font-weight: bold;
            background: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h2>Annual Income Tax Calculation</h2>
        <p>Tax Year 2025/26</p>
    </div>

    <!-- SUMMARY -->
    <div class="summary-box">
        <table class="info-table">
            <tr>
                <td class="text-left"><strong>Annual Income:</strong></td>
                <td>LKR {{ number_format($annual_income) }}</td>
            </tr>
            <tr>
                <td class="text-left"><strong>Total Tax Payable:</strong></td>
                <td><strong>LKR {{ number_format($total_tax) }}</strong></td>
            </tr>
        </table>
    </div>

    <!-- BREAKDOWN TABLE -->
    <h4>Tax Breakdown</h4>

    <table>
        <thead>
            <tr>
                <th class="text-left">Rate</th>
                <th>Taxable Amount (LKR)</th>
                <th>Tax (LKR)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($breakdown as $row)
            <tr>
                <td class="text-left">{{ $row['rate'] }}%</td>
                <td>{{ number_format($row['taxable']) }}</td>
                <td>{{ number_format($row['tax']) }}</td>
            </tr>
            @endforeach

            <tr class="total-row">
                <td class="text-left" colspan="2">Total Tax</td>
                <td>{{ number_format($total_tax) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Generated on {{ now()->format('d M Y H:i') }} |
        This report is computer generated and does not require signature.
    </div>

</body>
</html>
