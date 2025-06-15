<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('transaksi', [DashboardController::class, 'transaksi'])->name('transaksi');
Route::get('cek', [DashboardController::class, 'cek'])->name('cek');
Route::get('riwayat', [DashboardController::class, 'riwayat'])->name('riwayat');
Route::resource('kategori', KategoriController::class);
Route::resource('produk', ProdukController::class);
Route::resource('user', UserController::class);
