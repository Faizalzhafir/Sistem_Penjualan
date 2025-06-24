<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $response = Http::get(config('app.api_url') . '/api/produk');

        if ($response->successful()) {
            $produk = $response->json()['data'];
            return view('Admin.pages.transaksi.index', compact('produk'));
        }
    
        return back()->with('error', 'Gagal memuat data produk dari API.');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'produk_data' => 'required|json',
            'total' => 'required|numeric',
            'bayar' => 'required|numeric',
            'diterima' => 'required|numeric',
            'jenis_transaksi' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        // Kirim data ke API menggunakan HTTP client
        $response = Http::timeout(10)->post(config('app.api_url') . '/api/transaksi', [
            'user_id' => auth()->id(),
            'produk_data' => json_decode($request->produk_data, true),
            'total' => $request->total,
            'total_diskon' => $request->total_diskon,
            'bayar' => $request->bayar,
            'diterima' => $request->diterima,
            'jenis_transaksi' => $request->jenis_transaksi,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        dd($response->json());

        if ($response->successful()) {
            $data = $response->json();
            return redirect()->route('cek', ['id' => $data['id']])
                ->with('success', 'Transaksi berhasil disimpan melalui API!');
        } else {
            return back()->with('error', 'Transaksi gagal: ' . $response->body());
        } 
        
    }

    public function show($id) {

        //$detail = TransaksiDetail::with('produk')->where('transaksi_id', $transaksi)->get();
        $response = Http::get(config('app.api_url') . "/api/transaksi/{$id}");

        if ($response->successful()) {
            $transaksi = $response->json()['data'];
            return view('Admin.pages.transaksi.detail', compact('transaksi'));
        }

        return back()->with('error', 'Detail transaksi tidak ditemukan.');
    }

    public function cek($id)
    {
        $transaksi = Transaksi::with('user', 'details.produk')->findOrFail($id);
        return view('Admin.pages.transaksi.cek', compact('transaksi'));
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

    public function destroy($id)
    {
       $response = Http::delete(config('app.api_url') . "/api/transaksi/{$id}");

        if ($response->successful()) {
            return redirect()->route('riwayat')->with('success', 'Transaksi berhasil dihapus.');
        }
        
        //dd($response);

        return back()->with('error', 'Gagal menghapus transaksi.');
    }
}
