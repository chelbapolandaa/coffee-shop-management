<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 10, 2);
            $table->string('kategori')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });

        // Tambahkan data dummy langsung setelah tabel dibuat
        DB::statement("
            INSERT INTO `menus` (`nama_menu`, `deskripsi`, `harga`, `kategori`, `gambar`, `created_at`, `updated_at`) VALUES
            ('Kopi Tubruk Jawa', 'Kopi hitam khas Jawa dengan rasa kuat dan aroma khas tradisional.', 12000.00, 'Kopi Panas', 'menu/ffHGywXDSRDMyadtUjwXuq0A4FPlVnXv6fyp22Re.jpg', NOW(), NOW()),
            ('Es Kopi Susu Gula Aren', 'Campuran kopi espresso, susu segar, dan gula aren manis alami.', 18000.00, 'Kopi Dingin', 'menu/UeK0dIVNB6IA2Ztes0PdY8IGy11YMhBMX4qmmC53.jpg', NOW(), NOW()),
            ('Cappuccino', 'Perpaduan espresso, steamed milk, dan milk foam yang lembut.', 20000.00, 'Kopi Panas', 'menu/DDU6VsVnjwig7gQqQcpVGm4qp70XKiUDGfpJXnDf.webp', NOW(), NOW()),
            ('Latte Caramel', 'Kopi latte lembut dengan sirup caramel manis.', 22000.00, 'Kopi Dingin', 'menu/JaVaz2ZdFS7CSoPqkTGujoWRGe3GwsOyfipDTYWl.jpg', NOW(), NOW()),
            ('Americano', 'Kopi espresso dengan tambahan air panas, rasa ringan dan tidak terlalu pahit.', 15000.00, 'Kopi Panas', 'menu/7ZkSgC60e6ChrV2syAacHHfmG1g2c7p3jvLRWjfk.webp', NOW(), NOW()),
            ('Cold Brew', 'Kopi diseduh dingin selama 12 jam menghasilkan rasa halus dan rendah asam.', 25000.00, 'Kopi Dingin', 'menu/3OHPg6cA1R4Jd4ip8nPbgtDxSXXS0XcTF17wTCEO.jpg', NOW(), NOW()),
            ('Mocca Blend', 'Kopi dengan campuran cokelat dan susu untuk rasa manis seimbang.', 23000.00, 'Kopi Dingin', 'menu/9BIhchX41HSOjZ9cL0VEVRdWmryMO5X1HMeKL5ez.jpg', NOW(), NOW()),
            ('Teh Tarik', 'Minuman teh manis dengan susu, disajikan dengan busa lembut.', 12000.00, 'Non Kopi', 'menu/7cnzpvsnJe3kAhLAM2ztL5vBIBKZUqcXwm3aVJ8r.jpg', NOW(), NOW()),
            ('Roti Bakar Cokelat Keju', 'Roti bakar hangat dengan isi cokelat dan parutan keju leleh.', 15000.00, 'Snack', 'menu/KeJSLoJQLwveSotPsQl8GDHjLCn6saH7RaRmaVja.jpg', NOW(), NOW()),
            ('Pisang Goreng Original', 'Pisang goreng renyah dengan topping gula halus.', 10000.00, 'Snack', 'menu/GGxyswi5HfWGWTjGnZBxrmoKMSO6yZKrhcVsNk3f.webp', NOW(), NOW()),
            ('Donat Kopi', 'Donat lembut dengan glaze rasa kopi.', 12000.00, 'Snack', 'menu/6rMbYTHeo4y6dDaRZzrXjFoGvvTselRNeoBCpDkn.webp', NOW(), NOW()),
            ('Brown Sugar Latte', 'Kopi susu lembut dengan gula merah premium.', 23000.00, 'Kopi Dingin', 'menu/p4yU55aJYUNoaecU9JyegyFaSnbHySq08OIJdKvc.jpg', NOW(), NOW()),
            ('Matcha Latte', 'Minuman teh hijau Jepang dengan susu lembut.', 24000.00, 'Non Kopi', 'menu/oF1OBPE42XBYy7wF829aXzxi4P574FB7XurAlJpQ.webp', NOW(), NOW()),
            ('Air Mineral', 'Air mineral botolan dingin menyegarkan.', 8000.00, 'Minuman', 'menu/8Wz46qsHWYp6Z6WSNfDhaQCXaTIrVngUppCjk8Bu.jpg', NOW(), NOW());
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
