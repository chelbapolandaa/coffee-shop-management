<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\StrukturController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\CheckoutController;
use App\Models\Promo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Copy & paste seluruh file ini ke routes/web.php
|
*/

// ===========================
// HOMEPAGE
// ===========================
Route::get('/', function () {
    $promos = Promo::latest()->get();
    return view('home', compact('promos'));
});

// ===========================
// MENU PUBLIK (search + filter kategori)
// ===========================
Route::get('/menu-publik', function (Request $request) {

    $query = DB::table('menus');

    if ($request->search) {
        $query->where('nama_menu', 'like', '%' . $request->search . '%');
    }

    if ($request->kategori) {
        $query->where('kategori', $request->kategori);
    }

    $menu = $query->get();
    $kategoriList = DB::table('menus')->select('kategori')->distinct()->get();

    return view('menu-public', [
        'menu' => $menu,
        'kategoriList' => $kategoriList
    ]);
});

// ===========================
// CHECKOUT (online order)
// ===========================
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store']);
Route::get('/checkout-success/{invoice}', [CheckoutController::class, 'success']);

// ===========================
// CART / KERANJANG (sync + ajax)
// ===========================
Route::post('/cart/add', function(Request $request) {
    $cart = session()->get('cart', []);
    $id = $request->id;

    if(isset($cart[$id])) {
        $cart[$id]['qty'] += 1;
    } else {
        $menu = DB::table('menus')->where('id', $id)->first();
        $cart[$id] = [
            "nama_menu" => $menu->nama_menu,
            "harga" => $menu->harga,
            "gambar" => $menu->gambar,
            "qty" => 1,
        ];
    }

    session()->put('cart', $cart);
    return redirect('/keranjang')->with('success', 'Menu ditambahkan ke keranjang!');
});

Route::get('/keranjang', function () {
    $cart = session('cart', []);
    return view('keranjang', compact('cart'));
});

Route::post('/cart/add-ajax', function(Request $request) {
    $cart = session()->get('cart', []);
    $id = $request->id;

    if(isset($cart[$id])) {
        $cart[$id]['qty']++;
    } else {
        $menu = DB::table('menus')->where('id', $id)->first();
        $cart[$id] = [
            "nama_menu" => $menu->nama_menu,
            "harga" => $menu->harga,
            "gambar" => $menu->gambar,
            "qty" => 1,
        ];
    }

    session()->put('cart', $cart);
    return response()->json(['status' => 'success', 'cart' => $cart]);
});

Route::post('/cart/update-qty', function(Request $request) {
    $cart = session()->get('cart', []);
    $id = $request->id;

    if($request->qty === "inc") {
        $cart[$id]['qty']++;
    } else {
        $cart[$id]['qty']--;
        if($cart[$id]['qty'] <= 0) {
            unset($cart[$id]);
        }
    }

    session()->put('cart', $cart);
    return response()->json(['status' => 'success', 'cart' => $cart]);
});

Route::post('/cart/remove', function(Request $request) {
    $cart = session()->get('cart', []);
    unset($cart[$request->id]);
    session()->put('cart', $cart);

    return back();
});

// ===========================
// ADMIN ROUTES (butuh login)
// Semua route admin di bawah ini akan prefix '/admin'
// ===========================
Route::middleware(['auth'])->group(function () {

    // Dashboard (tidak dalam prefix admin supaya tetap di /dashboard)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Group admin routes under /admin
    Route::prefix('admin')->group(function () {

        // Pesanan (admin)
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
        Route::post('/orders/store', [OrderController::class, 'storeManual'])->name('admin.orders.storeManual');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::get('/orders/{id}/status/{status}', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

        // Menu (resource)
        Route::resource('menu', MenuController::class, ['as' => 'admin']);

        // Users (resource)
        Route::resource('users', UserController::class, ['as' => 'admin']);

        // Promo (resource)
        Route::resource('promos', PromoController::class, ['as' => 'admin']);

        // Laporan (filter + export)
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/export-pdf', [LaporanController::class, 'exportPDF'])->name('laporan.exportPDF');

        // Struktur Organisasi
        Route::get('/struktur', [StrukturController::class, 'index'])->name('admin.struktur.index');
        Route::post('/struktur/add', [StrukturController::class, 'store'])->name('admin.struktur.store');
        Route::post('/struktur/update', [StrukturController::class, 'update'])->name('admin.struktur.update');
        Route::delete('/struktur/{id}', [StrukturController::class, 'destroy'])->name('admin.struktur.destroy');

    });

});

// ===========================
// AUTH
// ===========================
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
