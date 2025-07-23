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
        Schema::table('santris', function (Blueprint $table) {
            $table->boolean('pendaftaran')->default(false);
            $table->boolean('bayar_pendaftaran')->default(false);
            $table->boolean('verifikasi_bayar_pendaftaran')->default(false);
            $table->boolean('upload_berkas')->default(false);
            $table->boolean('verifikasi_berkas')->default(false);
            $table->boolean('terima_undangan_ujian')->default(false);
            $table->boolean('ujian_seleksi')->default(false);
            $table->boolean('bayar_daftar_ulang')->default(false);
            $table->boolean('verifikasi_daftar_ulang')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            //
        });
    }
};
