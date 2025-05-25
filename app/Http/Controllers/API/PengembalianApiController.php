<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'peminjam' => 'required',
            'barang' => 'required',
            'jumlah' => 'required|integer',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'kondisi_barang' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('gambar')->store('pengembalian', 'public');

        $pengembalian = Pengembalian::create([
            'peminjam' => $request->peminjam,
            'barang' => $request->barang,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi_barang' => $request->kondisi_barang,
            'gambar' => $path,
        ]);

        return response()->json([
            'message' => 'Pengembalian berhasil ditambahkan',
            'data' => $pengembalian
        ], 201);
    }
}
