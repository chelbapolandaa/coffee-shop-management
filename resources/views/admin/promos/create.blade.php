@extends('layouts.admin')

@section('content')
<h3>Tambah Promo</h3>

<form action="/admin/promos" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Judul</label>
    <input type="text" name="title" class="form-control mb-3" required>

    <label>Deskripsi</label>
    <textarea name="description" class="form-control mb-3"></textarea>

    <label>Diskon (%)</label>
    <input type="number" name="diskon" class="form-control mb-3" min="0" max="100" required>

    <label>Gambar Promo</label>
    <input type="file" name="image" class="form-control mb-3">

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
