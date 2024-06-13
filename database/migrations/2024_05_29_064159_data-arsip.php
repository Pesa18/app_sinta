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
            $table->foreignId('pencipta_id')->constrained(
                table: 'master_pencipta',
                indexName: 'master_pencipta_id'
            );
            $table->foreignId('pengolah_id')->constrained(
                table: 'master_pengolah',
                indexName: 'master_pengolah_id'
            );
            $table->foreignId('kode_id')->constrained(
                table: 'master_kode',
                indexName: 'master_kode_id'
            );
            $table->foreignId('lokasi_id')->constrained(
                table: 'master_lokasi',
                indexName: 'master_lokasi_id'
            );
            $table->foreignId('media_id')->constrained(
                table: 'master_media',
                indexName: 'master_media_id'
            );
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'user_id'
            );
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
