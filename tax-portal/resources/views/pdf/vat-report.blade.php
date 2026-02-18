<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>VAT Calculation Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
        }

        .summary-box {
            background: #f4f4f4;
            padding: 12px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
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
            background: #fafafa;
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
        <h2>VAT Calculation Report</h2>
        <p>Business Transaction Summary</p>
    </div>

    <!-- SUMMARY BOX -->
    <div class="summary-box">
        <table>
            <tr>
                <td class="text-left"><strong>Transaction Amount:</strong></td>
                <td>LKR {{ number_format($amount, 2) }}</td>
            </tr>
            <tr>
                <td class="text-left"><strong>VAT Rate:</strong></td>
                <td>{{ $vat_rate }}%</td>
            </tr>
            <tr>
                <td class="text-left"><strong>VAT Amount:</strong></td>
                <td>LKR {{ number_format($vat_amount, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td class="text-left">Total Amount (Including VAT)</td>
                <td>LKR {{ number_format($total_amount, 2) }}</td>
            </tr>
        </table>
    </div>

    <!-- CALCULATION BREAKDOWN -->
    <h4>Calculation Formula</h4>

    <table>
        <tr>
            <td class="text-left">VAT Amount</td>
            <td>
                {{ number_format($amount, 2) }} × ({{ $vat_rate }} ÷ 100)
            </td>
        </tr>
        <tr>
            <td class="text-left">Computed VAT</td>
            <td>LKR {{ number_format($vat_amount, 2) }}</td>
        </tr>
        <tr class="total-row">
            <td class="text-left">Final Total</td>
            <td>LKR {{ number_format($total_amount, 2) }}</td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Generated on {{ now()->format('d M Y H:i') }} |
        This report is system generated and does not require signature.
    </div>

</body>
</html>
