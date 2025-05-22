<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPengembalianExport;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = Pengembalian::all();
        return view('pengembalian.index', compact('data'));
    }

    public function store(Request $request)
    {
        $status = $request->aksi == 'Dikembalikan' ? 'Dikembalikan' : 'Terlambat';

        $pengembalian = Pengembalian::create([
            'nama_peminjam' => $request->nama_peminjam,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi_barang' => $request->kondisi_barang,
            'aksi' => $request->aksi,
            'status' => $status,
        ]);

        return response()->json(['message' => 'Data pengembalian berhasil disimpan.'], 201);
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanPengembalianExport, 'laporan_pengembalian.xlsx');
    }
}
