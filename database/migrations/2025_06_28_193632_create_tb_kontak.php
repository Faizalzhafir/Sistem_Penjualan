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
        Schema::create('tb_kontak', function (Blueprint $table) {
            $table->id(); // Kolom 'id'
            $table->foreignId('user_id') // Foreign key ke tabel user
                  ->constrained('users') // Mengacu ke tabel 'users'
                  ->onDelete('cascade'); 
            $table->text('pesan'); // pesan
            $table->string('alamat'); //alamat
            $table->string('no_whatsapp'); // no whatapp
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kontak');
    }
};
