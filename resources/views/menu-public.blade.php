<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu Waroeng Dje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .menu-card {
            transition: 0.2s;
        }

        .menu-card:hover {
            transform: scale(1.03);
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
        }

        .menu-img {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">☕ Waroeng Dje</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/menu-publik">Menu</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#promo">Promo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#menu">Menu Favorit</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">Tentang Kami</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#location">Lokasi</a>
                </li>

                <!-- ✅ Login / Dashboard otomatis -->
                @guest
                    <li class="nav-item">
                        <a class="btn btn-dark ms-3" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-success ms-3" href="/dashboard">Dashboard</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
    </nav>


    <!-- SEARCH & SORT -->  
    <div class="container" style="margin-top: 70px;">
        <h2 class="fw-bold mb-4 text-center">☕ Daftar Menu Waroeng Dje</h2>

        <div class="mb-4 d-flex gap-3">

        <!-- ✅ Search -->
        <form action="/menu-publik" method="GET" class="d-flex" style="flex:1;">
            <input type="text" name="search" class="form-control"
                placeholder="Cari menu..." value="{{ request('search') }}">
        </form>

        <!-- ✅ Sort by Kategori -->
        <form action="/menu-publik" method="GET">
            <select name="kategori" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>

                @foreach($kategoriList as $k)
                    <option value="{{ $k->kategori }}" 
                        {{ request('kategori') == $k->kategori ? 'selected' : '' }}>
                        {{ $k->kategori }}
                    </option>
                @endforeach
            </select>
        </form>

    </div>

    
    <div class="row">
        @foreach ($menu as $m)
        <div class="col-md-4 mb-4">
            <div class="card menu-card">
                <img src="{{ asset('storage/'.$m->gambar) }}" class="menu-img" alt="">


                <div class="card-body">
                    <h5 class="fw-bold">{{ $m->nama_menu }}</h5>
                    <p class="text-muted">{{ $m->deskripsi }}</p>

                    <p class="fw-bold text-success">
                        Rp {{ number_format($m->harga, 0, ',', '.') }}
                    </p>

                    <button class="btn btn-dark w-100 addToCartBtn" data-id="{{ $m->id }}">
                        Tambah ke Keranjang
                    </button>

                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- ✅ POPUP CART -->
<div id="cartPopup" class="position-fixed top-0 end-0 p-3 shadow bg-white rounded"
     style="width: 350px; height: 100vh; display:none; overflow-y:auto; z-index:9999;">

    <h4 class="mb-3">🛒 Keranjang</h4>

    <div id="cartItems"></div>

    <hr>

    <h5 class="fw-bold">Total: <span id="cartTotal">Rp 0</span></h5>

    <a href="/keranjang" class="btn btn-success w-100 mt-3">Checkout</a>
</div>


<script>
document.querySelectorAll('.addToCartBtn').forEach(btn => {
    btn.addEventListener('click', function() {

        let id = this.getAttribute('data-id');

        fetch('/cart/add-ajax', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
        .then(res => res.json())
        .then(data => {
            updateCartPopup(data.cart);
            document.getElementById('cartPopup').style.display = 'block';
        });
    });
});

function updateCartPopup(cart) {
    let cartItemsDiv = document.getElementById('cartItems');
    cartItemsDiv.innerHTML = '';

    let total = 0;

    for (let id in cart) {
        let item = cart[id];
        let subtotal = item.harga * item.qty;
        total += subtotal;

        cartItemsDiv.innerHTML += `
            <div class="d-flex align-items-start mb-3 border-bottom pb-2">

                <!-- Gambar -->
                <img src="/storage/${item.gambar}" width="60" class="rounded me-2" alt="gambar">

                <!-- Detail item -->
                <div style="flex: 1;">
                    <strong>${item.nama_menu}</strong><br>

                    <!-- Qty control -->
                    <div class="d-flex align-items-center mt-2">
                        <button class="btn btn-sm btn-light qtyMinus" data-id="${id}">−</button>

                        <span class="mx-2 fw-bold">${item.qty}</span>

                        <button class="btn btn-sm btn-light qtyPlus" data-id="${id}">+</button>
                    </div>

                    <!-- Subtotal -->
                    <div class="mt-2 fw-bold text-success">
                        Rp ${subtotal.toLocaleString()}
                    </div>
                </div>

                <!-- Tombol hapus -->
                <button class="btn btn-sm btn-danger deleteItem" data-id="${id}">X</button>
            </div>
        `;
    }

    // Update total
    document.getElementById('cartTotal').innerText = "Rp " + total.toLocaleString();
}
// EVENT DELEGATION untuk tombol + / - / delete
document.addEventListener('click', function(e) {

    // ✅ Tombol tambah qty
    if (e.target.classList.contains('qtyPlus')) {
        let id = e.target.getAttribute('data-id');

        fetch('/cart/update-qty', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                id: id,
                qty: "inc"
            })
        })
        .then(res => res.json())
        .then(data => {
            updateCartPopup(data.cart);
        });
    }

    // ✅ Tombol kurangi qty
    if (e.target.classList.contains('qtyMinus')) {
        let id = e.target.getAttribute('data-id');

        fetch('/cart/update-qty', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                id: id,
                qty: "dec"
            })
        })
        .then(res => res.json())
        .then(data => {
            updateCartPopup(data.cart);
        });
    }

    // ✅ Tombol hapus item
    if (e.target.classList.contains('deleteItem')) {
        let id = e.target.getAttribute('data-id');

        fetch('/cart/delete', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id })
        })
        .then(res => res.json())
        .then(data => {
            updateCartPopup(data.cart);
        });
    }

});

</script>


</body>
</html>
