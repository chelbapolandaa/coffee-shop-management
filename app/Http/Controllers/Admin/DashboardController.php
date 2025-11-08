<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalMenu'     => Menu::count(),
            'totalPesanan'  => Order::count(),
            'totalPending'  => Order::where('status', 'pending')->count(),
            'totalUser'     => User::count(),
            'pesananTerbaru' => Order::with('items')->latest()->take(5)->get()
        ]);
    }
}
