<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            // Ayah
            $table->string('ayah_nama')->nullable();
            $table->string('ayah_nik', 16)->nullable();
            $table->string('ayah_tempat_lahir')->nullable();
            $table->date('ayah_dob')->nullable();
            $table->string('ayah_pekerjaan')->nullable();
            $table->enum('ayah_pend_terakhir', ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('ayah_jurusan')->nullable();
            $table->string('ayah_no_hp')->nullable();
            $table->string('ayah_email')->nullable();
            $table->enum('ayah_status', ['Hidup', 'Wafat'])->nullable();

            // Ibu
            $table->string('ibu_nama')->nullable();
            $table->string('ibu_nik', 16)->nullable();
            $table->string('ibu_tempat_lahir')->nullable();
            $table->date('ibu_dob')->nullable();
            $table->string('ibu_pekerjaan')->nullable();
            $table->enum('ibu_pend_terakhir', ['SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('ibu_jurusan')->nullable();
            $table->string('ibu_no_hp')->nullable();
            $table->string('ibu_email')->nullable();
            $table->enum('ibu_status', ['Hidup', 'Wafat'])->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropColumn([
                // Ayah
                'ayah_nama',
                'ayah_nik',
                'ayah_tempat_lahir',
                'ayah_dob',
                'ayah_pekerjaan',
                'ayah_pend_terakhir',
                'ayah_jurusan',
                'ayah_no_hp',
                'ayah_email',
                'ayah_status',

                // Ibu
                'ibu_nama',
                'ibu_nik',
                'ibu_tempat_lahir',
                'ibu_dob',
                'ibu_pekerjaan',
                'ibu_pend_terakhir',
                'ibu_jurusan',
                'ibu_no_hp',
                'ibu_email',
                'ibu_status',
            ]);
        });
    }
};
