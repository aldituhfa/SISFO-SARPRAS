<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Peminjaman::select('id', 'nama_peminjam', 'barang', 'jumlah', 'status')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Peminjam', 'Barang', 'Jumlah', 'Status'];
    }
}
