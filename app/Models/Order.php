<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'invoice',
        'nama',
        'whatsapp',
        'metode_pembayaran',
        'catatan',
        'total',
        'status',
        'user_id',
    ];

    // Relasi ke order_items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
