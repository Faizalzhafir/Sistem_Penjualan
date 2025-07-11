<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategoriId = $request->query('kategori');
        if ($kategoriId) {
            $produk = Produk::where('kategori_id', $kategoriId)->paginate(10);
        } else {
            $produk = Produk::paginate(10);
        }
        $kategori = Kategori::withCount('produk')->get();
        $setting = Setting::first();
        return view('User.produk', compact('produk','kategori','setting'));
    }
    public function cari(Request $request)
    {
        $keyword = $request->keyword;

        $produk = Produk::where('nama', 'like', "%{$keyword}%")->paginate(9);
    
        $kategori = Kategori::withCount('produk')->get();
        $setting = Setting::first();
    
        return view('User.produk', compact('produk', 'kategori', 'setting'));
    }  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
  
}
