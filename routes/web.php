<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;

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
Route::get('/keranjang', function () {
    return view('user.cart');
});
Route::get('produk', function () {
    return view('user.shop');
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

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('cek', [TransaksiController::class, 'cek'])->name('cek');
Route::get('riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat');
Route::resource('kategori', KategoriController::class);
Route::resource('/produk-list', ProdukController::class);
Route::resource('user', UserController::class);
Route::resource('settings', SettingController::class);
Route::resource('transaksi', TransaksiController::class);
