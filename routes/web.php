<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanPeminjamanController;
use App\Http\Controllers\LaporanPengembalianController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/data-barang', function () {
        return view('data-barang');
    })->name('data-barang');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{nama_kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/data-barang', [BarangController::class, 'index'])->name('data-barang');
    Route::post('/data-barang', [BarangController::class, 'store'])->name('data-barang.store');
    Route::delete('/data-barang/{id}', [BarangController::class, 'destroy'])->name('data-barang.destroy');
    Route::get('/data-barang/{id}/edit', [BarangController::class, 'edit'])->name('data-barang.edit');
    Route::put('/data-barang/{id}', [BarangController::class, 'update'])->name('data-barang.update');

    Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::put('/admin/peminjaman/{id}/terima', [PeminjamanController::class, 'terima'])->name('admin.peminjaman.terima');
    Route::put('/admin/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolak'])->name('admin.peminjaman.tolak');


    // Route::get('/pengembalians', [PengembalianController::class, 'index']);
    // Route::post('/pengembalians', [PengembalianController::class, 'store']);
    // Route::get('/pengembalians', [PengembalianController::class, 'view'])->name('pengembalians.view');

    // Tampilkan semua data pengembalian (admin)
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    // Tampilkan detail pengembalian (jika diperlukan)
    Route::get('/pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
    // Update aksi (diterima, terlambat, hilang) oleh admin
    Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');


    Route::get('/laporan-pengembalian', [LaporanPengembalianController::class, 'index'])->name('laporan.pengembalian');
    Route::get('/laporan-pengembalian/excel', [LaporanPengembalianController::class, 'exportExcel'])->name('laporan.pengembalian.excel');
    Route::get('/laporan-pengembalian/pdf', [LaporanPengembalianController::class, 'exportPDF'])->name('laporan.pengembalian.pdf');


    Route::get('/laporan-barang', [BarangController::class, 'laporan'])->name('laporan.barang');
    Route::get('/laporan-barang/pdf', [BarangController::class, 'exportPdf'])->name('laporan.barang.pdf');
    Route::get('/laporan-barang/excel', [BarangController::class, 'exportExcel'])->name('laporan.barang.excel');

    Route::get('/laporan', [LaporanPeminjamanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-excel', [LaporanPeminjamanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('/laporan/export-pdf', [LaporanPeminjamanController::class, 'exportPDF'])->name('laporan.export.pdf');

    Route::get('/penggunas', [PenggunaController::class, 'index'])->name('penggunas.index');
    Route::get('/penggunas/create', [PenggunaController::class, 'create'])->name('penggunas.create');
    Route::post('/penggunas', [PenggunaController::class, 'store'])->name('penggunas.store');
});

require __DIR__ . '/auth.php';
