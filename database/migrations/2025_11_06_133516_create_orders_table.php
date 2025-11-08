<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // kode pesanan (e.g. INV-20251106-001)
            $table->string('invoice')->unique();

            // untuk pesanan online
            $table->string('nama')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->text('catatan')->nullable();

            // untuk kasir / admin input manual
            $table->unsignedBigInteger('user_id')->nullable();

            // total harga
            $table->integer('total');

            // status
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');

            $table->timestamps();
        });

        // Tambahkan data dummy
        // Tambahkan data dummy 7 hari terakhir
        DB::table('orders')->insert([
            [
                'invoice' => 'INV-20251106-001',
                'nama' => 'Rizky Pratama',
                'whatsapp' => '081234567890',
                'metode_pembayaran' => 'Tunai',
                'catatan' => 'Minta tanpa gula.',
                'user_id' => 1,
                'total' => 51000,
                'status' => 'selesai',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'invoice' => 'INV-20251106-002',
                'nama' => 'Dewi Lestari',
                'whatsapp' => '089876543210',
                'metode_pembayaran' => 'QRIS',
                'catatan' => 'Tambahkan es batu banyak ya.',
                'user_id' => 2,
                'total' => 30000,
                'status' => 'diproses',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'invoice' => 'INV-20251106-003',
                'nama' => 'Andi Saputra',
                'whatsapp' => '082199887766',
                'metode_pembayaran' => 'Transfer Bank',
                'catatan' => 'Pesan 2 kopi tubruk.',
                'user_id' => 3,
                'total' => 56000,
                'status' => 'pending',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'invoice' => 'INV-20251106-004',
                'nama' => 'Siti Nurhaliza',
                'whatsapp' => '085212345678',
                'metode_pembayaran' => 'Tunai',
                'catatan' => 'Bungkus untuk dibawa pulang.',
                'user_id' => null,
                'total' => 25000,
                'status' => 'selesai',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'invoice' => 'INV-20251106-005',
                'nama' => 'Yoga Setiawan',
                'whatsapp' => '081233344455',
                'metode_pembayaran' => 'QRIS',
                'catatan' => 'Kirim ke meja nomor 3.',
                'user_id' => 1,
                'total' => 35000,
                'status' => 'diproses',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'invoice' => 'INV-20251106-006',
                'nama' => 'Citra Amelia',
                'whatsapp' => '087812345678',
                'metode_pembayaran' => 'Tunai',
                'catatan' => 'Tanpa susu.',
                'user_id' => null,
                'total' => 46000,
                'status' => 'pending',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],

            [
                'invoice' => 'INV-20251106-007',
                'nama' => 'Fajar Rahman',
                'whatsapp' => '089998887777',
                'metode_pembayaran' => 'QRIS',
                'catatan' => 'Kurangi manis.',
                'user_id' => 1,
                'total' => 28000,
                'status' => 'selesai',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'invoice' => 'INV-20251106-008',
                'nama' => 'Ahmad Taufik',
                'whatsapp' => '081222333444',
                'metode_pembayaran' => 'Tunai',
                'catatan' => '',
                'user_id' => null,
                'total' => 43000,
                'status' => 'diproses',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'invoice' => 'INV-20251106-009',
                'nama' => 'Melati Puspita',
                'whatsapp' => '087711223344',
                'metode_pembayaran' => 'Transfer Bank',
                'catatan' => 'Tambahkan whipped cream.',
                'user_id' => 2,
                'total' => 61000,
                'status' => 'pending',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'invoice' => 'INV-20251106-010',
                'nama' => 'Dimas Ardiansyah',
                'whatsapp' => '082244556677',
                'metode_pembayaran' => 'QRIS',
                'catatan' => '',
                'user_id' => null,
                'total' => 33000,
                'status' => 'selesai',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            [
                'invoice' => 'INV-20251106-011',
                'nama' => 'Putri Maharani',
                'whatsapp' => '081566778899',
                'metode_pembayaran' => 'Tunai',
                'catatan' => 'Dine in.',
                'user_id' => 1,
                'total' => 27000,
                'status' => 'diproses',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'invoice' => 'INV-20251106-012',
                'nama' => 'Rahma Salsabila',
                'whatsapp' => '089912345678',
                'metode_pembayaran' => 'QRIS',
                'catatan' => '',
                'user_id' => 3,
                'total' => 49000,
                'status' => 'pending',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
    ]);

    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
