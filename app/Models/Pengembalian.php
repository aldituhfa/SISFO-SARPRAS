<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjam',
        'barang',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'kondisi_barang',
        'gambar',
        'aksi',
        'status',
    ];
}
