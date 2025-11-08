@extends('layouts.admin')

@section('content')

<h3 class="fw-bold mb-4">Tambah Pesanan</h3>

<form action="{{ url('/admin/orders/store') }}" method="POST">
    @csrf

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Pelanggan</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Nomor WhatsApp (opsional)</label>
                <input type="text" name="whatsapp" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="cash">Cash</option>
                    <option value="qris">QRIS</option>
                    <option value="transfer">Transfer</option>
                </select>
            </div>

        </div>
    </div>

    {{-- MENU --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Daftar Menu</h5>

            <div id="menu-container">
                <div class="row menu-item mb-3">
                    <div class="col-md-6">
                        <label>Menu</label>
                        <select name="menu_id[]" class="form-control">
                            @foreach($menus as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_menu }} - Rp {{ number_format($m->harga) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Qty</label>
                        <input type="number" name="qty[]" class="form-control" min="1" value="1">
                    </div>

                    <div class="col-md-3">
                        <label>Aksi</label><br>
                        <button type="button" class="btn btn-danger btn-sm remove-menu">Hapus</button>
                    </div>
                </div>
            </div>

            <button type="button" id="tambahMenu" class="btn btn-secondary btn-sm">+ Tambah Menu</button>
        </div>
    </div>

    <button class="btn btn-primary">Simpan Pesanan</button>
    <a href="/admin/orders" class="btn btn-secondary">Kembali</a>

</form>


<script>
document.getElementById('tambahMenu').addEventListener('click', function () {
    let container = document.getElementById('menu-container');
    let item = container.querySelector('.menu-item').cloneNode(true);
    container.appendChild(item);
});

// Hapus menu
document.addEventListener('click', function(e){
    if(e.target.classList.contains('remove-menu')){
        e.target.closest('.menu-item').remove();
    }
});
</script>

@endsection
