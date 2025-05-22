<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang', 'nama_barang', 'kategori_id', 'stok', 'satuan', 'lokasi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
