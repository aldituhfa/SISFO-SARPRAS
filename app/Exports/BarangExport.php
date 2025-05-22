<?php
namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Barang::with('kategori')->get()->map(function ($barang, $index) {
            return [
                'No' => $index + 1,
                'Nama Barang' => $barang->nama_barang,
                'Kategori' => $barang->kategori->nama_kategori ?? '-',
                'Stok' => $barang->stok,
                'Satuan' => $barang->satuan,
                'Lokasi' => $barang->lokasi,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Nama Barang', 'Kategori', 'Stok', 'Satuan', 'Lokasi'];
    }
}
