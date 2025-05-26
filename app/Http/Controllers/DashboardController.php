<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahBarang = Barang::count();
        $jumlahKategori = Kategori::count(); 
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahPengembalian = Pengembalian::count();
        $jumlahUser = Pengguna::count();
        // Ambil 2 barang terbaru
        $barangBaru = Barang::latest()->take(3)->get();
        // Ambil 2 peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::latest()->take(3)->get();

        return view('dashboard', compact('jumlahBarang', 'jumlahKategori', 'jumlahPeminjaman', 'jumlahPengembalian', 'jumlahUser', 'barangBaru',
            'peminjamanTerbaru'));

    }
}

//     $barangPerKategori = Barang::with('kategori')
    //     ->get()
    //     ->groupBy('kategori.nama')
    //     ->map(fn($items) => $items->sum('stok'));

    // return view('dashboard', compact('jumlahBarang', 'jumlahKategori', 'barangPerKategori'));