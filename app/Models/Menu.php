<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Nama tabel (sesuai migration: menus)
    protected $table = 'menus';

    // Kolom yang boleh diisi secara massal (fillable)
    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
        'kategori',
        'gambar',
    ];
}
