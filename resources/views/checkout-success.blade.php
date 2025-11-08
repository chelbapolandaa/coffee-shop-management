<!DOCTYPE html>
<html>
<head>
    <title>Pemesanan Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container text-center mt-5">
    <h1 class="text-success fw-bold">✅ Pesanan Berhasil!</h1>
    <p class="mb-4">Terima kasih! Pesanan Anda telah kami terima.</p>

    <h3 class="fw-bold">Kode Pesanan:</h3>
    <h2 class="text-primary">{{ $invoice }}</h2>

    <a href="/menu-publik" class="btn btn-dark mt-4">Kembali ke Menu</a>
</div>

</body>
</html>
