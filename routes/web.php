<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\User\KeranjangController;
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
Route::get('/', function () {
    return view('user.index');
});

Route::get('/kontak', function () {
    return view('user.contact');
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
Route::resource('login', AuthLoginController::class);
Route::resource('register', AuthRegisterController::class);
Route::resource('produk', UserProdukController::class);
Route::resource('keranjang', KeranjangController::class);
Route::middleware(['auth', 'cek.role:admin,kasir'])->group(function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('transaksi', TransaksiController::class);
    Route::get('cek', [TransaksiController::class, 'cek'])->name('cek');
    Route::get('riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat');
});
Route::middleware(['auth', 'cek.role:admin'])->group(function (){
    Route::resource('kategori', KategoriController::class);
    Route::resource('produk-list', ProdukController::class);
    Route::resource('user', UserController::class);
    Route::put('/user/{id}/status', [UserController::class, 'updateStatus'])->name('user.updateStatus');
    Route::resource('settings', SettingController::class);
});

