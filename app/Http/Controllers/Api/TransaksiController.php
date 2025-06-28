<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;

class TransaksiController extends Controller
{
    public function index()
    {
        $produk = Transaksi::with(['user', 'details.produk'])->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $transaksi,
        ]);
    }



    public function store(Request $request) {
        try {
            // Validasi dan simpan...
            $request->validate([
                'produk_data' => 'required|array',
                'total' => 'required|numeric',
                'bayar' => 'required|numeric',
                'diterima' => 'required|numeric',
            ]);
        
            $produkData = $request->produk_data;
        
            // Buat kode transaksi otomatis
            $kodeTransaksi = 'TRX' . now()->format('YmdHis') . rand(100, 999);
        
            // Simpan ke transaksi utama
            $transaksi = Transaksi::create([
                'user_id' => $request->user_id,
                'kode_transaksi' => $kodeTransaksi,
                'total' => $request->total,
                'total_diskon' => $request->total_diskon,
                'bayar' => $request->bayar,
                'diterima' => $request->diterima,
                'jenis_transaksi' => $request->jenis_transaksi,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => $request->metode_pembayaran == 'cash' ? 'lunas' : 'pending'
            ]);
        
            // Simpan detail produk
            foreach ($produkData as $item) {
                if (!isset($item['product_id'], $item['jumlah'], $item['harga_jual'])) {
                    continue; // atau throw error
                }
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['jumlah'],
                    'price' => $item['harga_jual'],
                ]);
    
                // Kurangi stok
                $produk = Produk::find($item['product_id']);
                if ($produk->stok < $item['jumlah']) {
                    throw new \Exception("Stok produk {$produk->nama} tidak mencukupi");
                }
                $produk->stok -= $item['jumlah'];
                $produk->save();
            }
        
            return response()->json([
                'message' => 'Transaksi berhasil',
                'id' => $transaksi->id, // <- ID dikembalikan ke client
                'kode_transaksi' => $transaksi->kode_transaksi,
                'status' => 'success'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
        
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['user', 'details.produk'])->find($id);

        if (!$transaksi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaksi tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $transaksi,
        ]);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }

        $transaksi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi berhasil dihapus'
        ]);
    }


}
