<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::all();
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function show($id)
    {
        return Pengembalian::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        $request->validate([
            'aksi' => 'required|in:diterima,terlambat,hilang',
        ]);

        $pengembalian->aksi = $request->aksi;

        // Atur status berdasarkan aksi
        if ($request->aksi === 'diterima') {
            $pengembalian->status = 'dikembalikan';
        } elseif ($request->aksi === 'terlambat') {
            $pengembalian->status = 'terlambat';
        } elseif ($request->aksi === 'hilang') {
            $pengembalian->status = 'hilang';
        }

        $pengembalian->save();

        return redirect()->back()->with('success', 'Aksi berhasil diperbarui.');
    }

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

        Pengembalian::create([
            'peminjam' => $request->peminjam,
            'barang' => $request->barang,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi_barang' => $request->kondisi_barang,
            'gambar' => $path,
        ]);

        return response()->json(['message' => 'Pengembalian berhasil ditambahkan'], 201);
    }
}
