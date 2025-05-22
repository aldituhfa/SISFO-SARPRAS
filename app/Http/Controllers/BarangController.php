<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Exports\BarangExport;
use App\Exports\GenericExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $barangs = Barang::with('kategori')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_barang', 'like', "%$keyword%");
            })
            ->orderBy('id', 'asc')
            ->paginate(5) // Gunakan paginate langsung, tanpa get()
            ->appends($request->query());

        $kategoris = Kategori::all();
        return view('data-barang', compact('barangs', 'kategoris', 'keyword'));
    }


    public function apiIndex()
    {
        $dataBarang = Barang::with('kategori')->get();
        return response()->json($dataBarang);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer',
            'satuan' => 'required',
            'lokasi' => 'required'
        ]);

        Barang::create($request->all());
        return redirect()->route('data-barang')->with('success', 'Barang berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('data-barang')->with('success', 'Barang berhasil dihapus');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();

        return view('edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required',
            'lokasi' => 'required',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'lokasi' => $request->lokasi,
        ]);
        return redirect()->route('data-barang')->with('success', 'Data barang berhasil diupdate.');
    }

    public function laporan()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barang.laporan', compact('barangs'));
    }

    public function exportPdf()
    {
        $barangs = Barang::with('kategori')->get();
        $pdf = Pdf::loadView('barang.laporan_pdf', compact('barangs'));
        return $pdf->download('laporan-barang.pdf');
    }

    public function exportExcel()
    {
        $data = Barang::with('kategori')->get()->map(fn($b) => [
            $b->id,
            $b->nama,
            $b->kategori->nama ?? '-',
            $b->stok,
        ])->toArray();

        return Excel::download(new GenericExport(['ID', 'Nama', 'Kategori', 'Stok'], $data), 'laporan_stok_barang.xlsx');
    }
    // public function exportExcel()
    // {
    //     return Excel::download(new BarangExport, 'laporan-barang.xlsx');
    // }
    public function countBarang()
    {
        $jumlah = Barang::count();

        return response()->json([
            'jumlah_barang' => $jumlah
        ]);
    }

    public function terbaru()
    {
        return Barang::orderBy('created_at', 'desc')->take(3)->get();
    }
}
