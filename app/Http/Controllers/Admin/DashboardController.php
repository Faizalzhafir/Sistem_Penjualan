<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Admin.dashboard');
    }

    public function transaksi()
    {
        $produk = Produk::with('kategori')->get();
        return view('Admin.pages.transaksi', compact('produk'));
    }

    public function cek()
    {
        return view('Admin.pages.cek');
    }

    public function riwayat()
    {
        return view('Admin.pages.riwayat');
    }

}
