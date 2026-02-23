<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Salary Slip</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .section-title { font-weight: bold; margin-top: 15px; margin-bottom: 5px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .table td, .table th { border: 1px solid #ddd; padding: 6px; }
        .table th { background-color: #f2f2f2; }
        .right { text-align: right; }
        .no-border td { border: none; padding: 4px 0; }
        .footer { margin-top: 20px; font-size: 10px; text-align: center; }
    </style>
</head>
<body>

<div class="header">
    <h2>{{ $company_name ?? 'Company Name' }}</h2>
    <h3>Salary Slip - {{ $month }}</h3>
</div>

<div class="section-title">Employee Details</div>
<table class="table">
    <tr>
        <td><strong>Name:</strong> {{ $employee_name }}</td>
        <td><strong>Designation:</strong> {{ $designation }}</td>
    </tr>
    <tr>
        <td><strong>EPF No:</strong> {{ $epf_no }}</td>
        <td><strong>NIC No:</strong> {{ $nic }}</td>
    </tr>
</table>

<div class="section-title">Payment Details</div>
<table class="table no-border">
    <tr>
        <td><strong>Period:</strong> {{ $month }}</td>
        <td class="right"><strong>Issue Date:</strong> {{ $issue_date }}</td>
    </tr>
</table>

<div class="section-title">Earnings</div>
<table class="table">
    <tr><th>Description</th><th class="right">Amount (LKR)</th></tr>
    <tr><td>Basic Salary</td><td class="right">{{ number_format($basic,2) }}</td></tr>
    <tr><td>Allowances</td><td class="right">{{ number_format($allowances,2) }}</td></tr>
    <tr><td>Other Payments</td><td class="right">{{ number_format($other,2) }}</td></tr>
    <tr><th>Gross Salary</th><th class="right">{{ number_format($gross,2) }}</th></tr>
</table>

<div class="section-title">Deductions</div>
<table class="table">
    <tr><th>Description</th><th class="right">Amount (LKR)</th></tr>
    <tr><td>EPF (8%)</td><td class="right">{{ number_format($epf_employee,2) }}</td></tr>
    <tr><td>APIT</td><td class="right">{{ number_format($apit,2) }}</td></tr>
    <tr><th>Total Deductions</th><th class="right">{{ number_format($total_deductions,2) }}</th></tr>
    <tr><th>Net Salary</th><th class="right">{{ number_format($net,2) }}</th></tr>
</table>

<p><strong>* ETF Contribution by Employer (3%):</strong> LKR {{ number_format($etf_employer,2) }}</p>

<div class="footer">
    This is a computer-generated salary slip and does not require signature.
</div>

</body>
</html>