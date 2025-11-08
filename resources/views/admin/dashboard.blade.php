@extends('layouts.admin')

@section('content')

<h3 class="fw-bold mb-4">Dashboard Admin</h3>

<div class="row g-4">

    {{-- Total Menu --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="fw-bold text-primary">{{ $totalMenu }}</h1>
                <p class="m-0">Total Menu</p>
            </div>
        </div>
    </div>

    {{-- Total Pesanan --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="fw-bold text-success">{{ $totalPesanan }}</h1>
                <p class="m-0">Total Pesanan</p>
            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="fw-bold text-warning">{{ $totalPending }}</h1>
                <p class="m-0">Pesanan Pending</p>
            </div>
        </div>
    </div>

    {{-- Total User --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1 class="fw-bold text-dark">{{ $totalUser }}</h1>
                <p class="m-0">Total Pengguna</p>
            </div>
        </div>
    </div>
</div>

{{-- PESANAN TERBARU --}}
<div class="card shadow-sm border-0 mt-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Pesanan Terbaru</h5>

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Invoice</th>
                    <th>Nama</th>
                    <th>Menu</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pesananTerbaru as $order)
                <tr>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ $order->nama }}</td>
                    <td>
                        @foreach($order->items as $item)
                            • {{ $item->menu }} (x{{ $item->qty }})<br>
                        @endforeach
                    </td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($order->status == 'diproses')
                            <span class="badge bg-primary">Diproses</span>
                        @elseif($order->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada pesanan masuk</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
