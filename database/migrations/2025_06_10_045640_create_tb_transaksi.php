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
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('total');
            
            // Tambahan kolom penting:
            $table->enum('jenis_transaksi', ['offline', 'online'])->default('offline');
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'qris', 'payment_gateway'])->nullable();
            $table->enum('status_pembayaran', ['pending', 'lunas', 'gagal'])->default('pending');
            $table->string('kode_transaksi')->unique(); // TRX20250617001 dst
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
