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
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->id(); // Kolom 'id'
            $table->foreignId('kategori_id') // Foreign key ke tabel kategori
                  ->constrained('tb_kategori') // Mengacu ke tabel 'kategori'
                  ->onDelete('cascade');    // Jika kategori dihapus, produk ikut terhapus

            $table->string('kode')->unique(); // Kode produk harus unik
            $table->string('nama'); // Nama produk
            $table->decimal('harga_beli', 15, 2); // Harga beli
            $table->decimal('harga_jual', 15, 2); // Harga jual
            $table->decimal('diskon', 5, 2)->default(0); // Diskon dalam persen (misal 10.00%)
            $table->integer('stok')->default(0); // Jumlah stok
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_produk');
    }
};
