<!DOCTYPE html>
<html>
<head>
    <title>Sale Report PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; }
        .total { margin-top: 20px; font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>TECH ZONE - SALES REPORT</h2>
        <p>Period: {{ $startDate }} to {{ $endDate }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'Guest' }}</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Revenue: ${{ number_format($totalSales, 2) }}
    </div>
</body>
</html>