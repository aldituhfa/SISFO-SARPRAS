<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalians';
    protected $fillable = [
        'nama_peminjam', 'nama_barang', 'jumlah',
        'tanggal_pinjam', 'tanggal_kembali', 'kondisi_barang',
        'aksi', 'status'
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
