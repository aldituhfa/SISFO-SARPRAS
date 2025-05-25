<?php

use App\Http\Controllers\API\PengembalianApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenggunaController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [PenggunaController::class, 'login']);

Route::get('/barang', [BarangController::class, 'apiIndex']);
Route::get('/barang/count', [BarangController::class, 'countBarang']);
Route::get('/barang/terbaru', [BarangController::class, 'terbaru']);

Route::post('/peminjaman', [PeminjamanController::class, 'store']);
Route::get('/status-peminjaman', [PeminjamanController::class, 'cekStatus']);
Route::get('/peminjaman', [PeminjamanController::class, 'apiPeminjaman']);


Route::get('/pengembalian', [PengembalianController::class, 'index']);
Route::post('/pengembalian', [PengembalianController::class, 'store']);
Route::post('/pengembalian', [PengembalianApiController::class, 'store']);