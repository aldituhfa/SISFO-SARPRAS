<?php

namespace App\Http\Controllers;

use App\Models\LaporanPeminjaman;
use App\Models\Peminjaman;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $peminjaman = Peminjaman::paginate(10);
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    // Terima Peminjaman
    public function terima($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman disetujui.');
    }

    // Tolak Peminjaman
    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman ditolak.');
    }

    // Simpan dari Flutter
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'tanggal_pinjam' => 'required|date',
            'barang' => 'required',
            'jumlah' => 'required|integer',
        ]);

        $peminjaman = Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'barang' => $request->barang,
            'jumlah' => $request->jumlah,
            'status' => 'menunggu',
        ]);

        return response()->json(['message' => 'Peminjaman dikirim dan menunggu persetujuan'], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = $request->status; // 'Diterima' atau 'Ditolak'
        $peminjaman->save();

        // Cek apakah sudah ada laporan
        $existing = LaporanPeminjaman::where('peminjaman_id', $peminjaman->id)->first();
        if (!$existing) {
            // Tambahkan laporan jika belum ada
            LaporanPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'nama_peminjam' => $peminjaman->user->name,
                'barang' => $peminjaman->barang,
                'jumlah' => $peminjaman->jumlah,
                'status' => $peminjaman->status,
            ]);
        } else {
            // Jika sudah ada, perbarui statusnya
            $existing->update(['status' => $peminjaman->status]);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function cekStatus(Request $request)
    {
        $nama = $request->query('nama');
        $peminjaman = Peminjaman::where('nama_peminjam', $nama)->latest()->first();

        if (!$peminjaman) {
            return response()->json(['status' => 'not_found'], 404);
        }

        return response()->json(['status' => $peminjaman->status], 200);
    }

    public function apiPeminjaman()
    {
        $data = Peminjaman::where('status', 'dipinjam')->get();

        $formatted = $data->map(function ($item) {
            return [
                'nama_peminjam' => $item->nama_peminjam,
                'tanggal_pinjam' => $item->tanggal_pinjam,
                'barang' => $item->barang,
                'jumlah' => $item->jumlah
            ];
        });

        return response()->json($formatted);
    }

    public function peminjamanTerakhir(Request $request)
    {
        $email = $request->query('email');

        $peminjaman = Peminjaman::where('nama_peminjam', $email)->latest()->first();

        if ($peminjaman) {
            return response()->json([
                'barang' => $peminjaman->barang,
                'jumlah' => $peminjaman->jumlah,
                'status' => $peminjaman->status,
            ]);
        } else {
            return response()->json(['message' => 'Tidak ada peminjaman ditemukan'], 404);
        }
    }
}
