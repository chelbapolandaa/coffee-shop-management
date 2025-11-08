<!DOCTYPE html>
<html>
<head>
    <title>Checkout Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="fw-bold mb-4">🧾 Form Pemesanan Online</h2>

    <div class="row">
        <div class="col-md-7">

            <form method="POST" action="/checkout">
                @csrf

                <div class="mb-3">
                    <label class="fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="form-select" required>
                        <option value="">Pilih Metode</option>
                        <option>QRIS</option>
                        <option>Transfer Bank</option>
                        <option>Bayar di Toko</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Catatan (Opsional)</label>
                    <textarea name="catatan" class="form-control"></textarea>
                </div>

                <button class="btn btn-success w-100">Kirim Pesanan</button>

            </form>

        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header fw-bold">Ringkasan Pesanan</div>

                <ul class="list-group list-group-flush">
                    @php $total = 0; @endphp

                    @foreach($cart as $c)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $c['nama_menu'] }} (x{{ $c['qty'] }})</span>
                            <span>Rp {{ number_format($c['harga'] * $c['qty'], 0, ',', '.') }}</span>
                        </li>

                        @php $total += ($c['harga'] * $c['qty']); @endphp
                    @endforeach
                </ul>

                <div class="card-footer fw-bold">
                    Total: Rp {{ number_format($total, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
