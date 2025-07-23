<?php

namespace App\Filament\Resources\SantriResource\Pages;

use App\Filament\Resources\SantriResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;

class ViewSantri extends ViewRecord
{
    protected static string $resource = SantriResource::class;

    public function getHeaderActions(): array
    {
        return [];
    }

    public function getInfolistSchema(): array
    {
        return [
            Section::make('Data Pribadi')->schema([
                TextEntry::make('nama'),
                TextEntry::make('nisn'),
                TextEntry::make('nik'),
                TextEntry::make('tempat_lahir'),
                TextEntry::make('dob')->date(),
                TextEntry::make('jenis_kelamin'),
                TextEntry::make('gol_darah'),
                TextEntry::make('jml_saudara'),
                TextEntry::make('anak_ke'),
                TextEntry::make('alamat'),
                TextEntry::make('desa_kel'),
                TextEntry::make('kecamatan'),
                TextEntry::make('kab_kota'),
                TextEntry::make('provinsi'),
                TextEntry::make('negara'),
                TextEntry::make('kode_pos'),
                TextEntry::make('hobi'),
                TextEntry::make('cita_cita'),
                TextEntry::make('jml_hafalan'),
                TextEntry::make('penanggung_jawab_biaya'),
                TextEntry::make('penanggung_lainnya'),
            ])->columns(3),

            Section::make('Sekolah Asal')->schema([
                TextEntry::make('sekolah'),
                TextEntry::make('npsn'),
                TextEntry::make('tahun_lulus'),
                TextEntry::make('alamat_sekolah'),
                TextEntry::make('desa_kel_sekolah'),
                TextEntry::make('kec_sekolah'),
                TextEntry::make('kab_kota_sekolah'),
                TextEntry::make('prov_sekolah'),
                TextEntry::make('negara_sekolah'),
                TextEntry::make('telepon_sekolah'),
            ])->columns(3),

            Section::make('Data Ayah')->schema([
                TextEntry::make('ayah_nama'),
                TextEntry::make('ayah_nik'),
                TextEntry::make('ayah_tempat_lahir'),
                TextEntry::make('ayah_dob')->date(),
                TextEntry::make('ayah_pekerjaan'),
                TextEntry::make('ayah_pend_terakhir'),
                TextEntry::make('ayah_jurusan'),
                TextEntry::make('ayah_no_hp'),
                TextEntry::make('ayah_email'),
                TextEntry::make('ayah_status'),
            ])->columns(3),

            Section::make('Data Ibu')->schema([
                TextEntry::make('ibu_nama'),
                TextEntry::make('ibu_nik'),
                TextEntry::make('ibu_tempat_lahir'),
                TextEntry::make('ibu_dob')->date(),
                TextEntry::make('ibu_pekerjaan'),
                TextEntry::make('ibu_pend_terakhir'),
                TextEntry::make('ibu_jurusan'),
                TextEntry::make('ibu_no_hp'),
                TextEntry::make('ibu_email'),
                TextEntry::make('ibu_status'),
            ])->columns(3),

            Section::make('Jenjang Tujuan')->schema([
                TextEntry::make('jenjang'),
                TextEntry::make('kelas'),
            ])->columns(2),
        ];
    }
}
