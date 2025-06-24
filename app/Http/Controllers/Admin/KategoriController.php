<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Http;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get(config('app.api_url') . '/api/kategori');

        if ($response->successful()) {
            $kategori = $response->json()['data'];
            return view('Admin.pages.kategori.index', compact('kategori'));
        }
    
        return back()->with('error', 'Gagal memuat data kategori dari API');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255|unique:tb_kategori,nama',
        ]);

        // Kirim data ke API menggunakan HTTP client
        $response = Http::timeout(10)->post(config('app.api_url') . '/api/kategori', [
            'nama' => $request->nama
        ]);

        //dd($response->json());

        if (!$response->successful()) {
            dd($response->status(), $response->body());
        }

        if ($response->successful()) {
            $data = $response->json();
            return redirect()->route('kategori.index')
                ->with('success', 'Kategori berhasil disimpan melalui API!');
        } else {
            return back()->with('error', 'Kategori gagal: ' . $response->body());
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $response = Http::get(config('app.api_url') . "/api/kategori/{$id}");

        if ($response->successful()) {
            $kategori = $response->json()['data'];
            return view('admin.pages.kategori.edit', compact('kategori'));
        }

        return back()->with('error', 'Kategori tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Kirim data ke API menggunakan HTTP client
        $response = Http::timeout(10)->put(config('app.api_url') . "/api/kategori/{$id}", [
            'nama' => $request->nama
        ]);

        //dd($response->json());

        if (!$response->successful()) {
            dd($response->status(), $response->body());
        }

        if ($response->successful()) {
            $data = $response->json();
            return redirect()->route('kategori.index')
                ->with('success', 'Kategori berhasil diubah melalui API!');
        } else {
            return back()->with('error', 'Kategori gagal: ' . $response->body());
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = Http::delete(config('app.api_url') . "/api/kategori/{$id}");

        if ($response->successful()) {
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
        }
        
        //dd($response);

        return back()->with('error', 'Gagal menghapus Kategori.');
    }
}
