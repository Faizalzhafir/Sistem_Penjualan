<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'tb_produk';
    protected $guarded = [];

    //fungsi one to one ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'product_id');
    }

    public function produk() {
        return $this->hasMany(Produk::class, 'product_id', 'id');
    }
}
