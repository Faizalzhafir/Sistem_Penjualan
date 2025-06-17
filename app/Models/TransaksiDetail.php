<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi_detail';
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }

    public function details()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
