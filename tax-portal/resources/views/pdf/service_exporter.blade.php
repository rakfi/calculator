<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Service Export Tax Calculation</title>

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

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 12px;
            color: #666;
        }

        .summary-box {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f5f5f5;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            color: #000;
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

    <div class="header">
        <div class="title">Individual Service Exporter Tax Calculation</div>
        <div class="subtitle">Tax Year 2025/26</div>
    </div>

    <div class="summary-box">
        <strong>Income Summary</strong>
        <table>
            <tr>
                <td>Monthly Income (USD)</td>
                <td class="text-right">
                    ${{ number_format($data['monthly_usd'], 2) }}
                </td>
            </tr>
            <tr>
                <td>Conversion Rate (USD → LKR)</td>
                <td class="text-right">
                    {{ number_format($data['rate'], 2) }}
                </td>
            </tr>
            <tr>
                <td>Monthly Income (LKR)</td>
                <td class="text-right">
                    LKR {{ number_format($data['monthly_lkr'], 2) }}
                </td>
            </tr>
            <tr>
                <td>Annual Income (LKR)</td>
                <td class="text-right">
                    LKR {{ number_format($data['annual_lkr'], 2) }}
                </td>
            </tr>
        </table>
    </div>

    <strong>Progressive Tax Breakdown</strong>

    <table>
        <thead>
            <tr>
                <th>Income Range</th>
                <th>Rate</th>
                <th class="text-right">Taxable Amount</th>
                <th class="text-right">Tax</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['breakdown'] as $row)
            <tr>
                <td>{{ $row['range'] }}</td>
                <td>{{ $row['rate'] }}%</td>
                <td class="text-right">
                    LKR {{ number_format($row['taxable'], 2) }}
                </td>
                <td class="text-right">
                    LKR {{ number_format($row['tax'], 2) }}
                </td>
            </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="3">Total Annual Tax Payable</td>
                <td class="text-right">
                    LKR {{ number_format($data['tax'], 2) }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->format('Y-m-d H:i:s') }} <br>
        This is a system-generated tax estimation report.
    </div>

</body>
</html>
