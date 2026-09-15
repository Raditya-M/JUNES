<?php
/**
 * File         : web.php
 * Deskripsi    : Definisi seluruh route web untuk aplikasi
 *                Pemesanan Kamar Hotel Sederhana.
 * Initial State: Belum ada endpoint yang terdaftar
 * Final State  : Seluruh endpoint (index, form, store, show, riwayat) terdaftar
 * Author       : Junior Web Developer
 * Versi/Tanggal: v1.0 / 2026-09-15
 */

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

// Halaman utama: Produk, Daftar Harga, Tentang Kami
Route::get('/', [HotelController::class, 'index'])->name('home');

// Halaman form pemesanan kamar
Route::get('/pesan', [HotelController::class, 'create'])->name('pesanan.create');

// Proses simpan data pemesanan (dari form submit / POST)
Route::post('/pesan', [HotelController::class, 'store'])->name('pesanan.store');

// Halaman detail / rekap satu pesanan berdasarkan ID
Route::get('/pesanan/{pemesanan}', [HotelController::class, 'show'])->name('pesanan.show');

// Halaman daftar seluruh riwayat pemesanan
Route::get('/riwayat', [HotelController::class, 'riwayat'])->name('pesanan.riwayat');