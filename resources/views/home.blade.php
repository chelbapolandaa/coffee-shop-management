<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waroeng Dje Coffee</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            background: url('https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=1350&q=80') center/cover no-repeat;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 1px 1px 5px #000;
        }

        .menu-card img {
            height: 180px;
            object-fit: cover;
        }
    </style>
</head>

<body>

<!-- ✅ NAVBAR -->
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

<!-- ✅ HERO SECTION -->
<section class="hero">
    <div class="text-center">
        <h1 class="fw-bold display-4">Selamat Datang di Waroeng Dje Coffee</h1>
        <p class="lead">Tempat terbaik untuk menikmati kopi dan suasana nyaman.</p>
        <a href="/menu-publik" class="btn btn-light btn-lg fw-bold">Lihat Menu</a>
    </div>
</section>

<div class="container py-5">

    <!-- ✅ PROMO -->
    <section id="promo" class="mb-5">
        <h2 class="fw-bold mb-3">Promo Hari Ini</h2>

        @if(isset($promos) && count($promos) > 0)
            <div class="row">

                @foreach($promos as $promo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">

                        <!-- Gambar Promo -->
                        @if($promo->image)
                            <img src="{{ asset('storage/' . $promo->image) }}" 
                                class="card-img-top" 
                                style="height:180px; object-fit:cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                style="height:180px;">
                                Tidak ada gambar
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="fw-bold">{{ $promo->title }}</h5>
                            <p class="text-muted">{{ $promo->description }}</p>

                            @if($promo->diskon > 0)
                                <span class="badge bg-danger mb-2">Diskon {{ $promo->diskon }}%</span>
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        @else
            <p class="text-muted">Belum ada promo tersedia.</p>
        @endif
    </section>


    <!-- ✅ MENU FAVORIT -->
    <section id="menu" class="mb-5">
        <h2 class="fw-bold mb-3">Menu Favorit</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card menu-card">
                    <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=800&q=80" class="card-img-top">
                    <div class="card-body">
                        <h5>Es Kopi Susu</h5>
                        <p class="text-muted">Kopi susu gula aren khas Waroeng Dje.</p>
                        <p class="fw-bold">Rp 18.000</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card menu-card">
                    <img src="https://images.unsplash.com/photo-1470337458703-46ad1756a187?auto=format&fit=crop&w=800&q=80" class="card-img-top">
                    <div class="card-body">
                        <h5>Cappuccino</h5>
                        <p class="text-muted">Perpaduan espresso dan foam lembut.</p>
                        <p class="fw-bold">Rp 20.000</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card menu-card">
                    <img src="https://images.unsplash.com/photo-1588167056547-c183313da47e?auto=format&fit=crop&w=800&q=80" class="card-img-top">
                    <div class="card-body">
                        <h5>Snack Platter</h5>
                        <p class="text-muted">Cemilan gurih teman minum kopi.</p>
                        <p class="fw-bold">Rp 15.000</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ✅ TENTANG KAMI -->
    <section id="about" class="mb-5">
        <h2 class="fw-bold mb-3">Tentang Waroeng Dje</h2>
        <p>
            Waroeng Dje Coffee adalah coffee shop lokal dengan cita rasa klasik dan ambience yang hangat.
            Kami menggunakan biji kopi berkualitas dan menghadirkan suasana yang nyaman untuk nongkrong, kerja,
            atau sekadar menikmati kopi favorit Anda.
        </p>
    </section>

    <!-- ✅ TENTANG KAMI -->
<section id="about" class="mb-5">
    <div class="container">
        <h2 class="fw-bold mb-3">Tentang Waroeng Dje</h2>
        <p>
            Waroeng Dje Coffee adalah coffee shop lokal dengan cita rasa klasik dan ambience yang hangat.
            Kami menggunakan biji kopi berkualitas dan menghadirkan suasana yang nyaman untuk nongkrong, kerja,
            atau sekadar menikmati kopi favorit Anda.
        </p>
    </div>
</section>

<!-- ✅ STRUKTUR ORGANISASI -->
@php
    $struktur = \App\Models\StrukturOrganisasi::all();
@endphp

<section id="struktur" class="mb-5">
    <div class="container">
        <h2 class="fw-bold mb-3">Struktur Organisasi</h2>

        @if($struktur->count() > 0)
            <div class="row g-3">
                @foreach($struktur as $item)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm text-center">
                            <div class="card-body">
                                <h5 class="fw-bold">{{ $item->jabatan }}</h5>
                                <p class="text-muted mb-0">{{ $item->nama }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">Struktur organisasi belum tersedia.</p>
        @endif
    </div>
</section>


    <!-- ✅ LOKASI -->
    <section id="location" class="mb-5">
        <h2 class="fw-bold mb-3">Lokasi & Jam Buka</h2>
        <p>📍 Jln. Pemuda Ujung Kotabaru</p>
        <p>🕒 Buka setiap hari: 13.00 – 23.00</p>

        <!-- Google Maps Embed -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!"
            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </section>
</div>

<!-- ✅ FOOTER -->
<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">© {{ date('Y') }} Waroeng Dje Coffee. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
