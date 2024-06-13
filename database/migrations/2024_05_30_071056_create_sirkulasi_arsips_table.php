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
        Schema::create('sirkulasi_arsip', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arsip_id')->constrained(
                table: "data-arsip",
                indexName: "data_arsip_id"
            );
            $table->foreignId('user_id')->constrained(
                table: "users",
                indexName: "user_peminjam_id"
            );
            $table->string('keperluan');
            $table->date('tgl_pinjam');
            $table->date('tgl_pengembalian');
            $table->date('tgl_expire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sirkulasi_arsip');
    }
};
