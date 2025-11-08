<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('struktur_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan');
            $table->string('nama');
            $table->timestamps();
        });
        DB::table('struktur_organisasi')->insert([
            ['jabatan' => 'Owner', 'nama' => 'Jusri Lesmana', 'created_at' => now(), 'updated_at' => now()],
            ['jabatan' => 'Manager', 'nama' => 'Dewi Sari', 'created_at' => now(), 'updated_at' => now()],
            ['jabatan' => 'Barista', 'nama' => 'Riko Santoso', 'created_at' => now(), 'updated_at' => now()],
            ['jabatan' => 'Kasir', 'nama' => 'Maya Putri', 'created_at' => now(), 'updated_at' => now()],
            ['jabatan' => 'Marketing', 'nama' => 'Andi Pratama', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasi');
    }
};
