<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('Admin.pages.transaksi.index', compact('produk'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'produk_data' => 'required|json',
            'total' => 'required|numeric',
            'bayar' => 'required|numeric',
            'diterima' => 'required|numeric',
        ]);
    
        $produkData = json_decode($request->produk_data, true);
    
        // Buat kode transaksi otomatis
        $kodeTransaksi = 'TRX' . now()->format('YmdHis') . rand(100, 999);
    
        // Simpan ke transaksi utama
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'kode_transaksi' => $kodeTransaksi,
            'total' => $request->total,
            'total_diskon' => $request->total_diskon,
            'bayar' => $request->bayar,
            'diterima' => $request->diterima,
            'jenis_transaksi' => $request->jenis_transaksi,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'lunas',
        ]);
    
        // Simpan detail produk
        foreach ($produkData as $item) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['jumlah'],
                'price' => $item['harga_jual'],
            ]);
        }
    
        return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
        
    }

    public function cek()
    {
        return view('Admin.pages.transaksi.cek');
    }

    public function riwayat()
    {
        $transaksi = Transaksi::with('user', 'details')->get();
        return view('Admin.pages.transaksi.riwayat', compact('transaksi'));
    }
}
