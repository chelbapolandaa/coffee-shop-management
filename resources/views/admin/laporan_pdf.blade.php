<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3>Laporan Penjualan</h3>
    @if($startDate && $endDate)
        <p>Periode: {{ $startDate }} s/d {{ $endDate }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Invoice</th>
                <th>Menu</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ $item->menu }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
