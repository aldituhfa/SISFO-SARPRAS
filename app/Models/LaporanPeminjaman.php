<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'laporan_peminjaman';

    protected $fillable = [
        'nama_peminjam',
        'barang',
        'jumlah',
        'status',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
