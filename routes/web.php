<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;

Route::get('/', [BarangController::class, 'index'])->name('dashboard');

// 🔹 barang (tanpa index)
Route::resource('barang', BarangController::class)->except(['index']);

// 🔹 kategori (tanpa show)
Route::resource('kategori', KategoriController::class)->except(['show']);

Route::get('/bantuan', function () {
    return view('bantuan');
})->name('bantuan');
