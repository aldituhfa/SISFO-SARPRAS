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
            ->paginate(3)
            ->appends($request->query());

        $kategoris = Kategori::all();
        return view('data-barang', compact('barangs', 'kategoris', 'keyword',));
    }

    public function apiIndex()
    {
        $dataBarang = Barang::with('kategori')->get();
        return response()->json($dataBarang);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer',
            'satuan' => 'required',
            'lokasi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_barang', 'kategori_id', 'stok', 'satuan', 'lokasi']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/gambar-barang', $filename);
            $data['gambar'] = 'gambar-barang/' . $filename; // ✔️ Sama seperti di update()
        }


        Barang::create($data);
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
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required',
            'lokasi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barang = Barang::findOrFail($id);
        $data = $request->only(['nama_barang', 'kategori_id', 'stok', 'satuan', 'lokasi']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && file_exists(public_path('storage/' . $barang->gambar))) {
                unlink(public_path('storage/' . $barang->gambar));
            }

            // Simpan gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/gambar-barang', $filename);
            $data['gambar'] = 'gambar-barang/' . $filename;
        }

        $barang->update($data);
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
            $b->nama_barang,
            $b->kategori->nama ?? '-',
            $b->stok,
        ])->toArray();

        return Excel::download(new GenericExport(['ID', 'Nama', 'Kategori', 'Stok'], $data), 'laporan_stok_barang.xlsx');
    }

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
