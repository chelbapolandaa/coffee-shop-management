@extends('layouts.admin')

@section('content')
<div class="p-4 bg-white rounded shadow-sm">
    <h4 class="fw-bold mb-3">Edit Struktur Organisasi</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.struktur.update') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jabatan</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach($struktur as $item)
                    <tr>
                        <td>
                            <input type="text" name="jabatan[]" class="form-control" value="{{ $item->jabatan }}">
                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                        </td>
                        <td>
                            <input type="text" name="nama[]" class="form-control" value="{{ $item->nama }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
