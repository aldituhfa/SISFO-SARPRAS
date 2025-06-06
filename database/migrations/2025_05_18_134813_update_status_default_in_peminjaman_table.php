<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'dipinjam', 'ditolak'])
                ->default('menunggu')
                ->change();
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'dipinjam', 'ditolak'])
                ->default('ditolak') // atau null, tergantung sebelumnya
                ->change();
        });
    }
};
