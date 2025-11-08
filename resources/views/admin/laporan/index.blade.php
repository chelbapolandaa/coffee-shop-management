@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Laporan Penjualan</h2>

    {{-- FORM FILTER --}}
    <form method="GET" action="{{ route('laporan.index') }}" class="row mb-4">
        <div class="col-md-3">
            <label class="fw-semibold">Dari Tanggal</label>
            <input type="date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
        </div>
        <div class="col-md-3">
            <label class="fw-semibold">Sampai Tanggal</label>
            <input type="date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-2 d-flex align-items-end">
           <a href="{{ route('laporan.exportPDF', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-success w-100">
            Export PDF
           </a>
        </div>
    </form>

    {{-- TABEL LAPORAN (Ringkasan seperti dashboard) --}}
    <div class="table-responsive">
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
                @forelse($orders as $order)
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
                    <td colspan="6" class="text-center text-muted">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
