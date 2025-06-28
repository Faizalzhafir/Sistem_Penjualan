<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahUser = User::where('role', 'user')->count();
        $totalPenjualan = Transaksi::sum('total');
        $jumlahKategori = Kategori::count();
        $jumlahProduk = Produk::count();
        return view('Admin.dashboard', compact('jumlahUser','totalPenjualan', 'jumlahKategori', 'jumlahProduk'));
    }

}
