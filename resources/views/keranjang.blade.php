<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Waroeng Dje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container" style="margin-top: 100px;">

    <h2 class="fw-bold mb-4">🛒 Keranjang Pesanan</h2>

    @if(count($cart) == 0)
        <p class="text-muted">Keranjang masih kosong.</p>
        <a href="/menu-publik" class="btn btn-dark">Lihat Menu</a>
    @else

    <table class="table">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @php $grandTotal = 0; @endphp

            @foreach($cart as $id => $item)
            @php 
                $total = $item['harga'] * $item['qty']; 
                $grandTotal += $total;
            @endphp

            <tr>
                <td>{{ $item['nama_menu'] }}</td>
                <td>Rp {{ number_format($item['harga'],0,',','.') }}</td>
                <td>{{ $item['qty'] }}</td>
                <td>Rp {{ number_format($total,0,',','.') }}</td>
                <td>
                    <form action="/cart/remove" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

    <h4 class="fw-bold">Grand Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}</h4>

    <a href="/checkout" class="btn btn-success btn-lg mt-3">Lanjutkan Pemesanan</a>

    @endif

</div>

</body>
</html>
