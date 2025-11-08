<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (count($cart) == 0) {
            return redirect('/menu-publik')->with('error', 'Keranjang masih kosong!');
        }

        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'whatsapp' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        // Generate invoice (INV-YYYYMMDD-XXX)
        $date = date('Ymd');
        $countToday = DB::table('orders')->whereDate('created_at', today())->count() + 1;
        $invoice = 'INV-' . $date . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);

        // Hitung total
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $c) {
            $total += $c['harga'] * $c['qty'];
        }

        // Simpan order
        $orderId = DB::table('orders')->insertGetId([
            'invoice'           => $invoice,
            'nama'              => $request->nama,
            'whatsapp'          => $request->whatsapp,
            'metode_pembayaran' => $request->metode_pembayaran,
            'catatan'           => $request->catatan,
            'total'             => $total,
            'status'            => 'pending',
            'user_id'           => null,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Simpan item-item
        foreach ($cart as $item) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'menu'     => $item['nama_menu'],
                'harga'    => $item['harga'],
                'qty'      => $item['qty'],
                'subtotal' => $item['harga'] * $item['qty'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // kosongkan keranjang
        session()->forget('cart');

        return redirect('/checkout-success/' . $invoice);
    }

    public function success($invoice)
    {
        return view('checkout-success', compact('invoice'));
    }
}
