<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id(); // NO (auto increment)
            $table->string('peminjam'); // nama peminjam
            $table->string('barang'); // nama barang
            $table->integer('jumlah');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->string('kondisi_barang');
            $table->string('gambar'); // path gambar
            $table->enum('aksi', ['diterima', 'terlambat', 'hilang'])->nullable();
            $table->string('status')->nullable(); // otomatis disesuaikan dari aksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
