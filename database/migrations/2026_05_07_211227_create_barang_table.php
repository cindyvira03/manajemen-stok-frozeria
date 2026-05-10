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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            // WAJIB
            $table->string('nama_barang');
            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategori')
                ->nullOnDelete();
            $table->unsignedInteger('stok');
            $table->string('satuan');

            // OPSIONAL
            $table->decimal('harga_jual', 10, 2)->nullable();
            $table->unsignedInteger('stok_minimum')->nullable();
            $table->decimal('harga_beli', 10, 2)->nullable();
            $table->string('berat_atau_ukuran')->nullable();
            $table->string('lokasi_simpan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
