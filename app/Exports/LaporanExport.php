<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::with('items')->get()->map(function($order) {
            return [
                'Invoice' => $order->invoice,
                'Nama' => $order->nama,
                'Whatsapp' => $order->whatsapp,
                'Total' => $order->total,
                'Status' => $order->status,
                'Tanggal' => $order->created_at->format('Y-m-d H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Invoice',
            'Nama',
            'Whatsapp',
            'Total',
            'Status',
            'Tanggal'
        ];
    }
}
