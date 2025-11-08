<!DOCTYPE html>
<html>
<head>
    <title>Daftar Menu Waroeng Dje</title>
    <style>
        body { font-family: sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>☕ Daftar Menu Waroeng Dje</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
        </tr>
        @foreach ($menu as $m)
        <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->nama_menu }}</td>
            <td>{{ $m->kategori }}</td>
            <td>Rp {{ number_format($m->harga, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
