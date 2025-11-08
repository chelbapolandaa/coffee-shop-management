@extends('layouts.admin')

@section('content')
<h3 class="fw-bold mb-3">Daftar Promo</h3>

<a href="/admin/promos/create" class="btn btn-primary mb-3">Tambah Promo</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Diskon</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($promos as $promo)
        <tr>
            <td>
                @if($promo->image)
                    <img src="{{ asset('storage/'.$promo->image) }}" width="80">
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </td>
            <td>{{ $promo->title }}</td>
            <td>{{ $promo->diskon }}%</td>
            <td>
                <a href="/admin/promos/{{ $promo->id }}/edit" class="btn btn-warning btn-sm">Edit</a>

                <form action="/admin/promos/{{ $promo->id }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus promo?')" class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
