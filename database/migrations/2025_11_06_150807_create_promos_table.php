<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('title');                   // Judul promo
            $table->text('description')->nullable();   // Deskripsi promo
            $table->integer('diskon')->default(0);     // Persentase diskon
            $table->string('image')->nullable();       // Gambar promo
            $table->timestamps();
        });

        // ===== Dummy Data Promo =====
        DB::table('promos')->insert([
            [
                'title' => 'Promo Awal Bulan - Diskon 20% Semua Menu Kopi',
                'description' => 'Dapatkan potongan harga 20% untuk semua jenis kopi panas maupun dingin selama minggu pertama setiap bulan.',
                'diskon' => 20,
                'image' => 'promo/promo_awal_bulan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Buy 2 Get 1 Free Snack',
                'description' => 'Setiap pembelian 2 menu snack seperti roti bakar atau pisang goreng, gratis 1 menu snack serupa.',
                'diskon' => 33,
                'image' => 'promo/buy2get1_snack.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Happy Hour Kopi Susu Gula Aren',
                'description' => 'Nikmati diskon 25% untuk Es Kopi Susu Gula Aren mulai pukul 14.00 hingga 17.00 setiap hari.',
                'diskon' => 25,
                'image' => 'promo/happy_hour_gula_aren.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('promos');
    }
};
