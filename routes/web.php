<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\kasirController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\memberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\sesiController;
use App\Http\Controllers\transaksiController;

Route::middleware(['guest'])->group(function () {
    Route::get('login', [sesiController::class, 'index'])->name('login');
    Route::post('login', [sesiController::class, 'login']);
});

Route::get('', function () {
    return redirect('dashboard');
});

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [sesiController::class, 'logout']);
    Route::get('dashboard', [dashboardController::class, 'index']);
    Route::resource('product', productController::class);
    Route::resource('kategori', kategoriController::class)->middleware('UserAkses:admin');
    Route::resource('member', memberController::class)->middleware('UserAkses:kasir');
    Route::resource('kasir', kasirController::class)->middleware('UserAkses:admin');
    Route::resource('transaksi', transaksiController::class)->middleware('UserAkses:kasir');
    Route::delete('/transaksi/deleteProduct/{id}', [TransaksiController::class, 'deleteProduct']);
    Route::post('transaksi/delete-all', [TransaksiController::class, 'deleteAllProduct'])->name('transaksi.deleteAllProduct');
    Route::post('/transaksi/updateSession', [TransaksiController::class, 'updateSession'])->name('transaksi.updateSession');
    Route::post('transaksi/simpantransaksi', [TransaksiController::class, 'simpanTransaksi'])->name('transaksi.simpanTransaksi');
    Route::get('/download-struk/{filename}', [TransaksiController::class, 'downloadStruk'])->name('downloadStruk');
    Route::get('laporanProduct', [laporanController::class, 'laporanProduct'])->middleware('UserAkses:admin');
    Route::get('laporanMember', [laporanController::class, 'laporanMember']);
    Route::get('laporanKasir', [laporanController::class, 'laporanKasir'])->middleware('UserAkses:admin');
    Route::get('laporanTransaksi', [laporanController::class, 'laporanTransaksi'])->middleware('UserAkses:admin');
    Route::get('laporan/detail/{id}', [laporanController::class, 'laporanDetail'])->middleware('UserAkses:admin');
});
