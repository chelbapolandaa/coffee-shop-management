<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            $table->string('menu');
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('subtotal');

            $table->timestamps();
        });

        // ============================================
        // ✅ Data sinkron dengan total di tabel orders
        // ============================================

        DB::table('order_items')->insert([

            // ORDER 1 — total 51.000
            [ 'order_id'=>1,'menu'=>'Es Kopi Susu Gula Aren','harga'=>18000,'qty'=>2,'subtotal'=>36000 ],
            [ 'order_id'=>1,'menu'=>'Roti Bakar Cokelat Keju','harga'=>15000,'qty'=>1,'subtotal'=>15000 ],

            // ORDER 2 — total 30.000
            [ 'order_id'=>2,'menu'=>'Cappuccino','harga'=>20000,'qty'=>1,'subtotal'=>20000 ],
            [ 'order_id'=>2,'menu'=>'Pisang Goreng Original','harga'=>10000,'qty'=>1,'subtotal'=>10000 ],

            // ORDER 3 — total 56.000
            [ 'order_id'=>3,'menu'=>'Latte Caramel','harga'=>22000,'qty'=>2,'subtotal'=>44000 ],
            [ 'order_id'=>3,'menu'=>'Teh Tarik','harga'=>12000,'qty'=>1,'subtotal'=>12000 ],

            // ORDER 4 — total 25.000
            [ 'order_id'=>4,'menu'=>'Cold Brew','harga'=>25000,'qty'=>1,'subtotal'=>25000 ],

            // ORDER 5 — total 35.000
            [ 'order_id'=>5,'menu'=>'Brown Sugar Latte','harga'=>23000,'qty'=>1,'subtotal'=>23000 ],
            [ 'order_id'=>5,'menu'=>'Donat Kopi','harga'=>12000,'qty'=>1,'subtotal'=>12000 ],

            // ORDER 6 — total 46.000
            [ 'order_id'=>6,'menu'=>'Mocca Blend','harga'=>23000,'qty'=>2,'subtotal'=>46000 ],

            // ORDER 7 — total 28.000
            [ 'order_id'=>7,'menu'=>'Kopi Tubruk Jawa','harga'=>12000,'qty'=>1,'subtotal'=>12000 ],
            [ 'order_id'=>7,'menu'=>'Pisang Goreng Original','harga'=>10000,'qty'=>1,'subtotal'=>10000 ],
            [ 'order_id'=>7,'menu'=>'Air Mineral','harga'=>8000,'qty'=>1,'subtotal'=>8000 ],

            // ORDER 8 — total 43.000
            [ 'order_id'=>8,'menu'=>'Americano','harga'=>15000,'qty'=>1,'subtotal'=>15000 ],
            [ 'order_id'=>8,'menu'=>'Teh Tarik','harga'=>12000,'qty'=>1,'subtotal'=>12000 ],
            [ 'order_id'=>8,'menu'=>'Pisang Goreng Original','harga'=>10000,'qty'=>1,'subtotal'=>10000 ],
            [ 'order_id'=>8,'menu'=>'Air Mineral','harga'=>8000,'qty'=>1,'subtotal'=>8000 ],

            // ORDER 9 — total 61.000
            [ 'order_id'=>9,'menu'=>'Matcha Latte','harga'=>24000,'qty'=>2,'subtotal'=>48000 ],
            [ 'order_id'=>9,'menu'=>'Roti Bakar Cokelat Keju','harga'=>15000,'qty'=>1,'subtotal'=>15000 ],

            // ORDER 10 — total 33.000
            [ 'order_id'=>10,'menu'=>'Latte Caramel','harga'=>22000,'qty'=>1,'subtotal'=>22000 ],
            [ 'order_id'=>10,'menu'=>'Air Mineral','harga'=>8000,'qty'=>1,'subtotal'=>8000 ],
            [ 'order_id'=>10,'menu'=>'Pisang Goreng Original','harga'=>10000,'qty'=>1,'subtotal'=>10000 ],

            // ORDER 11 — total 27.000
            [ 'order_id'=>11,'menu'=>'Mocca Blend','harga'=>23000,'qty'=>1,'subtotal'=>23000 ],
            [ 'order_id'=>11,'menu'=>'Air Mineral','harga'=>8000,'qty'=>1,'subtotal'=>8000 ],

            // ORDER 12 — total 49.000
            [ 'order_id'=>12,'menu'=>'Matcha Latte','harga'=>24000,'qty'=>1,'subtotal'=>24000 ],
            [ 'order_id'=>12,'menu'=>'Brown Sugar Latte','harga'=>23000,'qty'=>1,'subtotal'=>23000 ],

        ]);
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
