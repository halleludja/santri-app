<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = [
        // Data Pribadi
        'nama',
        'nisn',
        'nik',
        'tempat_lahir',
        'dob',
        'jenis_kelamin',
        'gol_darah',
        'jml_saudara',
        'anak_ke',
        'alamat',
        'desa_kel',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'negara',
        'kode_pos',
        'hobi',
        'cita_cita',
        'jml_hafalan',
        'penanggung_jawab_biaya',
        'penanggung_lainnya',

        // Data Sekolah
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

        // Data Ayah
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

        // Data Ibu
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

        'jenjang',
        'kelas',
    ];

    protected $casts = [
        'dob' => 'date',
        'ayah_dob' => 'date',
        'ibu_dob' => 'date',
        'jml_saudara' => 'integer',
        'anak_ke' => 'integer',
        'jml_hafalan' => 'integer',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function scopeByJenjang($query, $jenjang)
    {
        return $query->where('jenjang', $jenjang);
    }

    public function scopeByKelas($query, $kelas)
    {
        return $query->where('kelas', $kelas);
    }
}
