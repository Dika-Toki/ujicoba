<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\BahanMasukController;
use Illuminate\Support\Facades\Route;

// Untuk menampilkan halaman (GET)
Route::get('/bahan', [BahanController::class, 'index'])->name('bahan.index');

// Untuk memproses simpan data (POST)
// Kita buat URL-nya berbeda agar tidak membingungkan browser
Route::post('/bahan/simpan', [BahanController::class, 'store'])->name('bahan.store');

// Jika ingin halaman utama langsung ke daftar bahan
Route::get('/', [BahanController::class, 'index']);


// Bahan Masuk
Route::get('/bahan_masuk', [BahanMasukController::class, 'index'])->name('bahan_masuk.index');
Route::post('/bahan_masuk/simpan', [BahanMasukController::class, 'store'])->name('bahan_masuk.store');
