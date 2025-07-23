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
            $table->string('sekolah')->nullable();
            $table->string('npsn', 10)->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->text('alamat_sekolah')->nullable();
            $table->string('desa_kel_sekolah')->nullable();
            $table->string('kec_sekolah')->nullable();
            $table->string('kab_kota_sekolah')->nullable();
            $table->string('prov_sekolah')->nullable();
            $table->string('negara_sekolah')->default('Indonesia');
            $table->string('telepon_sekolah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropColumn([
                'sekolah',
                'npsn',
                'tahun_lulus',
                'alamat_sekolah',
                'desa_kel_sekolah',
                'kec_sekolah',
                'kab_kota_sekolah',
                'prov_sekolah',
                'negara_sekolah',
                'telepon_sekolah',
            ]);
        });
    }
};
