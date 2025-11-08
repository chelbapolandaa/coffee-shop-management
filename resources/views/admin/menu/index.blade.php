@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Daftar Menu</h2>
    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Tambah Menu</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $menu->nama_menu }}</td>
                    <td>{{ $menu->kategori }}</td>
                    <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>
                        @if ($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" width="70">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus menu ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
