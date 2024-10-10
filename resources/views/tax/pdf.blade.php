<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Filing Information</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>Tax Filing Information</h1>
<h2>{{ $data->name }}</h2>

<table>
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>SSN</td>
        <td>{{ $data->ssn }}</td>
    </tr>
    <tr>
        <td>Address</td>
        <td>{{ $data->address }}</td>
    </tr>
    <tr>
        <td>W-2 Income</td>
        <td>${{ number_format($data->w2_income, 2) }}</td>
    </tr>
    <tr>
        <td>Self-Employment Income</td>
        <td>${{ number_format($data->self_employment_income, 2) }}</td>
    </tr>
    <tr>
        <td>Mortgage Interest</td>
        <td>${{ number_format($data->mortgage_interest, 2) }}</td>
    </tr>
    <tr>
        <td>Charitable Donations</td>
        <td>${{ number_format($data->charitable_donations, 2) }}</td>
    </tr>
    <tr>
        <td>Child Tax Credit</td>
        <td>${{ number_format($data->child_tax_credit, 2) }}</td>
    </tr>
    <tr>
        <td>Education Credit</td>
        <td>${{ number_format($data->education_credit, 2) }}</td>
    </tr>
    <tr>
        <td>Federal Tax Withheld</td>
        <td>${{ number_format($data->federal_tax_withheld, 2) }}</td>
    </tr>
    <tr>
        <td>State Tax Withheld</td>
        <td>${{ number_format($data->state_tax_withheld, 2) }}</td>
    </tr>
</table>

</body>
</html>
