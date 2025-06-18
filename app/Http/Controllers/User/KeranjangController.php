<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjang = Keranjang::with('produk')->get();
        return view('User.keranjang', compact('keranjang'));
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
        $userId = Auth::id();
        $produkId = $request->input('product_id');

        //Cek apakah produk sudah ada di keranjang user
        $item = Keranjang::where('user_id', $userId)
        ->where('product_id', $produkId)
        ->first();

        if($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            Keranjang::create([
                'user_id'=> $userId,
                'product_id'=> $produkId,
                'quantity' => 1,
            ]);
        }
        return redirect()->back()->with('success', 'Produk berhasil di tambahkan ke keranjang!');
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
        $item = Keranjang::findOrFail($id);
        if($item->user_id != auth()->id()) {
            abort(404);
        }
        if($request->aksi == 'tambah') {
            $item->quantity += 1;
        } elseif ($request->aksi == 'kurang') {
            if($item->quantity > 1) {
                $item->quantity -= 1;
            } else {
                $item->delete();
                return back();
            }
        }
        $item->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Keranjang::findOrFail($id);

        //Pastikan hanya user yeng punya keranjang ini yang bisa hapus
        if($item->user_id == auth()->id()) {
            $item->delete();
            return back()->with('success', 'Item berhasil di hapus dari keranjang!');
        }
        return back()->with('error', 'Anda tidak memiliki akses untuk menhapus item ini!');
    }
}
