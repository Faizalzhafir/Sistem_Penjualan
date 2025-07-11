<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\LandingpageController;
use App\Http\Controllers\User\ProdukController as UserProdukController;

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


Route::get('/user/dashboard', function () {
    return view('welcome');
})->name('user.dashboard');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::resource('login', AuthLoginController::class);
Route::resource('register', AuthRegisterController::class);
Route::resource('produk', UserProdukController::class);
Route::get('produk/cari', [UserProdukController::class, 'cari'])->name('produk.cari');
Route::resource('/', LandingpageController::class);


Route::middleware(['auth', 'cek.role:user'])->group(function (){
    Route::resource('keranjang', KeranjangController::class);
    Route::resource('kontak', ContactController::class);
});
Route::middleware(['auth', 'cek.role:admin,kasir'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/transaksi/{transaksi}/nota', [TransaksiController::class, 'cetakNota'])->name('transaksi.nota');
    Route::get('cek/{id}', [TransaksiController::class, 'cek'])->name('cek');
    Route::get('riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat');
    Route::get('laporan', [LaporanController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/pdf', [LaporanController::class, 'cetakPDF'])->name('laporan.pdf');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
});
Route::middleware(['auth', 'cek.role:admin'])->group(function (){
    Route::get('kategori/template', [KategoriController::class, 'kategoriTemplate'])->name('kategori.template');
    Route::resource('kategori', KategoriController::class);
    Route::post('kategori-import', [KategoriController::class, 'import'])->name('kategori.import');
    Route::get('produk-list/template', [ProdukController::class, 'produkTemplate'])->name('produk-list.template');
    Route::resource('produk-list', ProdukController::class);
    Route::post('produk-list-import', [ProdukController::class, 'import'])->name('produk-list.import');
    Route::resource('user', UserController::class);
    Route::put('/user/{id}/status', [UserController::class, 'updateStatus'])->name('user.updateStatus');
    Route::resource('settings', SettingController::class);
});

