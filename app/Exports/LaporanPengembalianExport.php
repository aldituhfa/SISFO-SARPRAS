<?php

namespace App\Exports;

use App\Models\Pengembalian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPengembalianExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pengembalian::select(
            'peminjam',
            'barang',
            'jumlah',
            'tanggal_pinjam',
            'tanggal_kembali',
            'kondisi_barang',
            'aksi',
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Peminjam',
            'Nama Barang',
            'Jumlah',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Kondisi Barang',
            'Aksi',
            'Status',
        ];
    }
}
