@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="fw-bold mb-4">Daftar Pesanan</h3>
        <a href="{{ url('/admin/orders/create') }}" class="btn btn-primary mb-3">
            + Tambah Pesanan
        </a>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th width="40">No</th>
                    <th>Nama Pelanggan</th>
                    <th>Menu</th>
                    <th width="120">Qty</th>
                    <th width="160">Total Harga</th>
                    <th width="150">Status</th>
                    <th width="150">Tanggal</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $i => $order)
                <tr>
                    <td>{{ $i + 1 }}</td>

                    <td>{{ $order->nama ?? '-' }}</td>

                    <td>
                        @foreach($order->items as $item)
                            • {{ $item->menu }} <br>
                        @endforeach
                    </td>

                    <td>
                        @foreach($order->items as $item)
                            x{{ $item->qty }} <br>
                        @endforeach
                    </td>

                    <td>
                        <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
                    </td>

                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($order->status == 'diproses')
                            <span class="badge bg-primary">Diproses</span>
                        @elseif($order->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>

                    <td>{{ $order->created_at->format('d M Y') }}</td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                Ubah Status
                            </button>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/orders/'.$order->id.'/status/pending') }}">
                                        Pending
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/orders/'.$order->id.'/status/diproses') }}">
                                        Diproses
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/orders/'.$order->id.'/status/selesai') }}">
                                        Selesai
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form action="{{ url('admin/orders/'.$order->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm w-100" 
                                onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection
