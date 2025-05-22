<?php

namespace App\Http\Controllers;

use App\Exports\LaporanPengembalianExport;
use App\Models\Pengembalian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanPengembalianController extends Controller
{
    public function index()
    {
        $laporan = Pengembalian::all();
        return view('laporan_pengembalian.index', compact('laporan'));
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanPengembalianExport, 'laporan_pengembalian.xlsx');
    }

    public function exportPDF()
    {
        $laporan = \App\Models\Pengembalian::all();
        $pdf = PDF::loadView('laporan_pengembalian.pdf', compact('laporan'));
        return $pdf->download('laporan_pengembalian.pdf');
    }
}
