<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Corporate Tax Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; line-height: 1.5; }
        h2 { text-align: center; color: #333; }
        .summary { margin-top: 20px; }
        .summary p { font-size: 16px; }
        .total { font-size: 18px; color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Corporate Estimated Tax Report</h2>

    <div class="summary">
        <p><strong>Total Annual Profit:</strong> LKR {{ number_format($data['annual_income'], 2) }}</p>
        <p class="total">Corporate Tax (30%): LKR {{ number_format($data['total_tax'], 2) }}</p>
    </div>

</body>
</html>
