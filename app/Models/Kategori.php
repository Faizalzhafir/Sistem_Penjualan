<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'tb_kategori';
    protected $guarded = [];

    //fungsi one to many ke model Produk
    public function produk() {
        return $this->hasMany(Produk::class, 'kategori_id', 'id');
    }
}
