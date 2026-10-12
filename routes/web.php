<?php

use App\Http\Controllers\TransaksiStokController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TransaksiStokController::class, 'dashboard'])->name('dashboard');

Route::get('/transaksi-masuk', [TransaksiStokController::class, 'indexMasuk'])->name('transaksi.masuk');
Route::post('/transaksi-masuk', [TransaksiStokController::class, 'storeMasuk'])->name('transaksi.masuk.store');

Route::get('/transaksi-keluar', [TransaksiStokController::class, 'indexKeluar'])->name('transaksi.keluar');
Route::post('/transaksi-keluar', [TransaksiStokController::class, 'storeKeluar'])->name('transaksi.keluar.store');
