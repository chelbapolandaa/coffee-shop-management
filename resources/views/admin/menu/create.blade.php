@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Tambah Menu</h2>
    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
