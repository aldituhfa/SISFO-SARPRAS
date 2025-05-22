<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\LaporanPeminjaman;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPeminjamanController extends Controller
{

    public function index()
    {
        $laporan = Peminjaman::oldest()->get();
        return view('laporan.index', compact('laporan'));
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanExport, 'laporan_peminjaman.xlsx');
    }

    public function exportPDF()
    {
        $laporan = Peminjaman::all();
        $pdf = PDF::loadView('laporan.pdf', compact('laporan'));
        return $pdf->download('laporan_peminjaman.pdf');
    }
}
