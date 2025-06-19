<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use App\Models\Setting;
//use Illuminate\Support\Facades\DB;

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

            // Kurangi stok
            $produk = Produk::find($item['product_id']);
            if ($produk->stok < $item['jumlah']) {
                throw new \Exception("Stok produk {$produk->nama} tidak mencukupi");
            }
            $produk->stok -= $item['jumlah'];
            $produk->save();
        }
    
        return redirect()->route('cek', ['id' => $transaksi->id])->with('success', 'Transaksi berhasil disimpan!');
        
    }

    public function show(Transaksi $transaksi) {

        //$detail = TransaksiDetail::with('produk')->where('transaksi_id', $transaksi)->get();
        $transaksi = Transaksi::with('user', 'details.produk')->findOrFail($transaksi->id);
        return view('Admin.pages.transaksi.detail', compact('transaksi'));
    }

    public function cek()
    {
        return view('Admin.pages.transaksi.cek');
    }

    public function cetakNota(Transaksi $transaksi)
    {
        $transaksi->load('user', 'details.produk');
        $setting = Setting::first();

        return view('Admin.pages.transaksi.nota', compact('transaksi', 'setting'));
    }

    public function riwayat()
    {
        $online = Transaksi::where('jenis_transaksi', 'online')->count();
        $pending = Transaksi::where('status_pembayaran', 'pending')->count();
        $lunas = Transaksi::where('status_pembayaran', 'lunas')->count();

        $transaksi = Transaksi::with('user', 'details')->get();
        return view('Admin.pages.transaksi.riwayat', compact('transaksi', 'online', 'pending', 'lunas'));
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('riwayat')->with('success', 'Transaksi berhasil dihapus.');
    }
}
