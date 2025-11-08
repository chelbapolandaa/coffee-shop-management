<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Order;


class OrderController extends Controller
{
    public function index()
    {
        // Ambil semua order + relasi item pesanan
        $orders = Order::with('items')->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Detail pesanan
        $order = Order::with('items')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function create()
    {
        // Ambil semua menu untuk dipilih kasir
        $menus = DB::table('menus')->get();
        return view('admin.orders.create', compact('menus'));
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'metode_pembayaran' => 'required',
            'menu_id.*' => 'required',
            'qty.*' => 'required|integer|min:1'
        ]);

        // Generate invoice
        $date = date('Ymd');
        $countToday = Order::whereDate('created_at', today())->count() + 1;
        $invoice = 'INV-' . $date . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);

        // Simpan order
        $orderId = Order::create([
            'invoice' => $invoice,
            'nama' => $request->nama,
            'whatsapp' => $request->whatsapp,
            'metode_pembayaran' => $request->metode_pembayaran,
            'catatan' => $request->catatan,
            'total' => 0,
            'status' => 'pending',
        ])->id;

        $total = 0;

        // Simpan order item
        foreach ($request->menu_id as $idx => $menuId) {
            $menu = DB::table('menus')->where('id', $menuId)->first();
            $qty = $request->qty[$idx];
            $subtotal = $menu->harga * $qty;

            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'menu' => $menu->nama_menu,
                'harga' => $menu->harga,
                'qty' => $qty,
                'subtotal' => $subtotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $total += $subtotal;
        }

        // Update total di tabel orders
        Order::where('id', $orderId)->update(['total' => $total]);

        return redirect('/admin/orders')->with('success', 'Pesanan berhasil ditambahkan!');
    }


    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete(); // hapus item pesanan
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
