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
        Schema::create('tb_transaksi_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('tb_transaksi')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('tb_produk')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('price'); // harga saat transaksi
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi_detail');
    }
};
