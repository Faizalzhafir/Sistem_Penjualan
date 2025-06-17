<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('admin.pages.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.pages.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:tb_kategori,id',
            'nama' => 'required|string|max:255',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'diskon' => 'nullable|integer',
            'stok' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);
    
        // Buat kode produk otomatis
        $prefix = strtoupper(substr(
            Kategori::find($validated['kategori_id'])->nama ?? 'XXX',
            0, 3
        ));
    
        $lastKode = Produk::where('kode', 'like', "$prefix%")->max('kode');
        $newNumber = str_pad(
            $lastKode ? (intval(substr($lastKode, strlen($prefix))) + 1) : 1,
            6, '0', STR_PAD_LEFT
        );
    
        $kodeBaru = $prefix . $newNumber;
    
        // Proses upload gambar jika ada
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->file('image')->storeAs('public/produk', $imageName);
        }
    
        // Simpan produk
        Produk::create([
            'kategori_id' => $validated['kategori_id'],
            'kode' => $kodeBaru,
            'nama' => $validated['nama'],
            'harga_beli' => $validated['harga_beli'],
            'harga_jual' => $validated['harga_jual'],
            'diskon' => $validated['diskon'] ?? 0,
            'stok' => $validated['stok'] ?? 0,
            'image' => $imageName,
        ]);
    
        return redirect()->route('produk-list.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $kategori = Kategori::all();
        return view('admin.pages.produk.edit', compact('produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:tb_kategori,id',
            'nama' => 'required|string|max:255|unique:tb_produk,nama',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'diskon' => 'nullable|integer',
            'stok' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Cek dan upload gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($produk->image && file_exists(public_path('uploads/produk/' . $produk->image))) {
                unlink(public_path('uploads/produk/' . $produk->image));
            }
    
            // Simpan gambar baru
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/produk'), $imageName);
            $produk->image = $imageName;
        }
    
        // Update field lainnya
        $produk->kategori_id = $validated['kategori_id'];
        $produk->nama = $validated['nama'];
        $produk->harga_beli = $validated['harga_beli'];
        $produk->harga_jual = $validated['harga_jual'];
        $produk->diskon = $validated['diskon'] ?? 0;
        $produk->stok = $validated['stok'] ?? 0;
    
        $produk->save();
    
        return redirect()->route('produk-list.index')->with('success', 'Produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk-list.index')->with('success', 'Produk berhasil dihapus.');
    }
}
