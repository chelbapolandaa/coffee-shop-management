<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        $query = Order::with('items')->orderBy('created_at', 'desc');

        // Jika filter aktif
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                $startDate . " 00:00:00",
                $endDate . " 23:59:59"
            ]);
        }

        $orders = $query->get();

        return view('admin.laporan.index', compact('orders', 'startDate', 'endDate'));
    }

    public function exportPDF(Request $request)
    {
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        $query = Order::with('items')->orderBy('created_at', 'desc');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                $startDate . " 00:00:00",
                $endDate . " 23:59:59"
            ]);
        }

        $orders = $query->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan_pdf', compact('orders', 'startDate', 'endDate'));

        return $pdf->download('laporan.pdf');
    }

}
