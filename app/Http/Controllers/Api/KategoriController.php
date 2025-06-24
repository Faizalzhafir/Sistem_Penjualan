<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index() {
        $kategori = Kategori::get();

        return response()->json([
            'status' => 'success',
            'data' => $kategori
        ]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255|unique:tb_kategori,nama',
        ]);

        $kategori = Kategori::create($request->only('nama'));

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan',
            'data' => $kategori
        ]);
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) {
            return response()->json(['status' => 'error', 'message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $kategori]);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        
        if (!$kategori) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori->update($request->only('nama'));

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil diupdate',
            'data' => $kategori
        ]);
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus'
        ]);
    }

}
