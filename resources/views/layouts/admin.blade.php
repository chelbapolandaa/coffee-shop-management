<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - WaroengDje Coffee</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        display: flex;
        background: #f5f5f5;
    }

    /* Sidebar */
    .sidebar {
        width: 240px;
        min-height: 100vh;
        background: #212529;
        color: white;
        position: fixed;
        padding-top: 20px;
        transition: all 0.3s;
    }

    .sidebar a {
        color: #ddd;
        text-decoration: none;
        display: block;
        padding: 12px 20px;
        font-size: 15px;
    }

    .sidebar a:hover, .sidebar a.active {
        background: #343a40;
        color: white;
    }

    .sidebar.hidden {
        margin-left: -240px;
    }

    /* Content */
    .content-wrapper {
        margin-left: 240px;
        width: 100%;
        transition: all 0.3s;
    }

    .content-wrapper.expanded {
        margin-left: 0;
    }

    /* Navbar */
    .admin-navbar {
        background: white;
        padding: 12px 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .toggle-btn {
        cursor: pointer;
        font-size: 20px;
    }
</style>
</head>

<body>

<div class="sidebar" id="sidebar">
    <h4 class="text-center text-white mb-4 fw-bold">Admin Panel</h4>

    <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        📊 Dashboard
    </a>

    <a href="{{ url('/admin/orders') }}" class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
        🧾 Pesanan
    </a>

    <a href="{{ url('/admin/menu') }}" class="{{ request()->is('admin/menu*') ? 'active' : '' }}">
        🍽️ Menu
    </a>

    <a href="{{ url('/admin/promos') }}" class="{{ request()->is('admin/promos*') ? 'active' : '' }}">
        🎉 Promo
    </a>

    <a href="{{ url('/admin/users') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
        👤 Pengguna
    </a>

    <a href="{{ url('/admin/laporan') }}" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
        📑 Laporan
    </a>

    <a href="{{ url('/logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="text-danger mt-3">
        🚪 Logout
    </a>

    <form id="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
    </form>
</div>

<div class="content-wrapper" id="content-wrapper">

    <nav class="admin-navbar d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <span class="toggle-btn me-3" id="toggle-sidebar">☰</span>
            <h5 class="fw-bold m-0">
                <a href="{{ url('/dashboard') }}" class="text-decoration-none text-dark">
                    WaroengDje
                </a>
            </h5>
        </div>

        <div class="d-flex align-items-center">
            <span class="me-3">Halo, {{ Auth::user()->name }}</span>
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=343a40&color=fff"
                 class="rounded-circle" width="38">
        </div>
    </nav>

    <div class="p-4">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const toggleBtn = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.getElementById('content-wrapper');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
        contentWrapper.classList.toggle('expanded');
    });
</script>

</body>
</html>
