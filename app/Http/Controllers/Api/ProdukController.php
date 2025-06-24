<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::with('kategori')->latest()->get();

        // Filter Kategori
        if ($request->filled('kategori_id')) {
            $produk->where('kategori_id', $request->kategori_id);
        }

        // Filter Stok
        if ($request->filled('stok_status')) {
            if ($request->stok_status === 'kosong') {
                $produk->where('stok', 0);
            } elseif ($request->stok_status === 'sedikit') {
                $produk->whereBetween('stok', [1, 10]);
            } elseif ($request->stok_status === 'tersedia') {
                $produk->where('stok', '>', 10);
            }
        }

        // Filter Diskon
        if ($request->filled('diskon_status')) {
            if ($request->diskon_status === 'ada') {
                $produk->where('diskon', '>', 0);
            } elseif ($request->diskon_status === 'tidak') {
                $produk->where('diskon', 0);
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $produk
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:tb_kategori,id',
            'nama' => 'required|string|max:255|unique:tb_produk,nama',
            'berat' => 'required|string|max:20',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'diskon' => 'nullable|integer',
            'stok' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
    
        $prefix = strtoupper(substr(Kategori::find($request->kategori_id)->nama ?? 'XXX', 0, 3));
        $lastKode = Produk::where('kode', 'like', "$prefix%")->max('kode');
        $newNumber = str_pad(
            $lastKode ? (intval(substr($lastKode, strlen($prefix))) + 1) : 1,
            6, '0', STR_PAD_LEFT
        );
        $kodeBaru = $prefix . $newNumber;
    
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/produk', $imageName);
        }
    
        $produk = Produk::create([
            'kategori_id' => $request->kategori_id,
            'kode' => $kodeBaru,
            'nama' => $request->nama,
            'berat' => $request->berat,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'diskon' => $request->diskon ?? 0,
            'stok' => $request->stok ?? 0,
            'image' => $imageName
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk
        ]);
    }

    public function show($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $produk]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'kategori_id' => 'required|exists:tb_kategori,id',
            'nama' => 'required|string|max:255|unique:tb_produk,nama,' . $id,
            'berat' => 'required|string|max:20',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'diskon' => 'nullable|integer',
            'stok' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada file image baru
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/produk', $imageName);
            $produk->image = $imageName;
        }

        // Update semua field
        $produk->kategori_id = $request->kategori_id;
        $produk->nama = $request->nama;
        $produk->berat = $request->berat;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->diskon = $request->diskon ?? 0;
        $produk->stok = $request->stok ?? 0;

        $produk->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil diupdate',
            'data' => $produk
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}
