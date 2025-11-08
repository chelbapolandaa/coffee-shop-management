@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Menu</h2>
    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $menu->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $menu->harga }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" value="{{ $menu->kategori }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Gambar</label><br>
            @if ($menu->gambar)
                <img src="{{ asset('storage/' . $menu->gambar) }}" width="100"><br>
            @endif
            <input type="file" name="gambar" class="form-control mt-2">
        </div>
        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
