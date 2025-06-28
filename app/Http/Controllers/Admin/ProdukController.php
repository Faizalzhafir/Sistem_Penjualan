<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Http;
use App\Imports\ProdukImport;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $queryParams = [];

        if ($request->filled('kategori_id')) {
            $queryParams['kategori_id'] = $request->kategori_id;
        }

        if ($request->filled('stok_status')) {
            $queryParams['stok_status'] = $request->stok_status;
        }

        if ($request->filled('diskon_status')) {
            $queryParams['diskon_status'] = $request->diskon_status;
        }
        
        $response = Http::get(config('app.api_url') . '/api/produk' , $queryParams);

        if ($response->successful()) {
            $produk = $response->json()['data'];

            $kategori = Http::get(config('app.api_url') . '/api/kategori')->json()['data'];
            return view('admin.pages.produk.index', compact('produk', 'kategori'));
        }

        return back()->with('error', 'Gagal memuat data produk.');
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
            'kategori_id' => 'required',
            'nama' => 'required|string|max:255',
            'berat' => 'required|string|max:20',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'diskon' => 'nullable|integer',
            'stok' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Siapkan array multipart
        $multipart = [];

        // Tambahkan input biasa
        foreach ($validated as $key => $value) {
            if ($key !== 'image') {
                $multipart[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        // Tambahkan file jika ada
        if ($request->hasFile('image')) {
            $multipart[] = [
                'name' => 'image',
                'contents' => fopen($request->file('image')->getRealPath(), 'r'),
                'filename' => $request->file('image')->getClientOriginalName(),
            ];
        }

        // Kirim ke API dengan multipart
        $response = Http::asMultipart()
            ->timeout(10)
            ->post(config('app.api_url') . '/api/produk', $multipart);

        if ($response->successful()) {
            return redirect()->route('produk-list.index')
                ->with('success', 'Produk berhasil ditambahkan via API');
        }

        return back()->with('error', 'Gagal menambahkan produk: ' . $response->body());
    }


    /**
     * Display the specified resource.
     */
    public function show(Produk $produk_list)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $response = Http::get(config('app.api_url') . "/api/produk/{$id}");

        if ($response->successful()) {
            $produk_list = $response->json()['data'];
            $kategori = Http::get(config('app.api_url') . '/api/kategori')->json()['data'];
            return view('admin.pages.produk.edit', compact('produk_list', 'kategori'));
        }

        return back()->with('error', 'Produk tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $multipart = [];

        $validated = $request->validate([
            'kategori_id' => 'required',
            'nama' => 'required|string|max:255',
            'berat' => 'required|string|max:20',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'diskon' => 'nullable|integer',
            'stok' => 'nullable|integer',
        ]);
    
        foreach ($validated as $key => $value) {
            if ($key !== 'image') {
                $multipart[] = [
                    'name' => $key,
                    'contents' => (string) $value,
                ];
            }
        }
        
        // Tambahkan file jika ada
        if ($request->hasFile('image')) {
            $multipart[] = [
                'name'     => 'image',
                'contents' => fopen($request->file('image')->getPathname(), 'r'),
                'filename' => $request->file('image')->getClientOriginalName(),
            ];
        }
        
        // Kirim dengan spoofing PUT
        $response = Http::asMultipart()->post(
            config('app.api_url') . "/api/produk/{$id}?_method=PUT",
            $multipart
        );

        if ($response->successful()) {
            return redirect()->route('produk-list.index')->with('success', 'Produk berhasil diupdate via API');
        }
    
        return back()->with('error', 'Gagal update: ' . $response->body());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $response = Http::delete(config('app.api_url') . "/api/produk/{$id}");

        if ($response->successful()) {
            return redirect()->route('produk-list.index')->with('success', 'Produk berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus produk.');
    }

    public function import(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);
    
        $import = new ProdukImport;
    
        try {
            // Import langsung dari file upload, tidak perlu disimpan ke storage
            Excel::import($import, $request->file('file'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal impor: ' . $e->getMessage());
        }
    
        $failures = $import->failures();
        \Log::info('Cek failures:', $failures->toArray());
    
        if ($failures->isNotEmpty()) {
            return redirect()->back()->with([
                'error' => 'Terdapat kesalahan pada beberapa baris Excel.',
                'failures' => $failures,
            ]);
        }

        return redirect()->route('produk-list.index')->with('success', 'Data produk berhasil diimpor');
    }

    public function produkTemplate() {
        return Excel::download(new \App\Exports\ProdukTemplate, 'Template_Produk.xlsx');
    }
}
