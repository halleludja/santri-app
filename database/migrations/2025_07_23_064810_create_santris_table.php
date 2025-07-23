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
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nisn', 16)->nullable();
            $table->string('nik', 16)->nullable();
            $table->string('tempat_lahir');
            $table->date('dob');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('gol_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->unsignedTinyInteger('jml_saudara')->nullable();
            $table->unsignedTinyInteger('anak_ke')->nullable();
            $table->text('alamat');
            $table->string('desa_kel');
            $table->string('kecamatan');
            $table->string('kab_kota');
            $table->string('provinsi');
            $table->string('negara')->default('Indonesia');
            $table->string('kode_pos', 10)->nullable();
            $table->string('hobi')->nullable();
            $table->string('cita_cita')->nullable();
            $table->unsignedTinyInteger('jml_hafalan')->nullable();
            $table->enum('penanggung_jawab_biaya', ['Orang Tua', 'Lainnya']);
            $table->string('penanggung_lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
