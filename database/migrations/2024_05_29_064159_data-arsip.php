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
        Schema::create('data-arsip', function (Blueprint $table) {
            $table->id();
            $table->uuid()->autoIncrement();
            $table->string('noarsip');
            $table->string('nama_arsip');
            $table->foreignId('pencipta_id')->nullable();
            $table->foreignId('pengolah_id')->nullable();
            $table->foreignId('kode_id')->nullable();
            $table->foreignId('lokasi_id')->nullable();
            $table->foreignId('media_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('arsip_pegawai_id')->nullable();
            $table->date('tanggal_arsip');
            $table->string('ket');
            $table->string('uraian');
            $table->string('jumlah_arsip');
            $table->string('no_box');
            $table->string('file_arsip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('data-arsip');
    }
};
