<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBarang = Barang::count();
        $jumlahKategori = Kategori::count(); 
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahUser = Pengguna::count();

        return view('dashboard', compact('jumlahBarang', 'jumlahKategori', 'jumlahPeminjaman', 'jumlahUser'));

    }
}

//     $barangPerKategori = Barang::with('kategori')
    //     ->get()
    //     ->groupBy('kategori.nama')
    //     ->map(fn($items) => $items->sum('stok'));

    // return view('dashboard', compact('jumlahBarang', 'jumlahKategori', 'barangPerKategori'));