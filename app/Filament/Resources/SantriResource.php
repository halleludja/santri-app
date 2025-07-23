<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SantriResource\Pages;
use App\Filament\Resources\SantriResource\RelationManagers;
use App\Models\Santri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use Filament\Forms\Components\Checkbox;

class SantriResource extends Resource
{
    protected static ?string $model = Santri::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // ✅ Section: Data Pribadi
                Section::make('Data Pribadi')
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('nisn')->label('NISN')->required()->numeric(),
                        TextInput::make('nik')->label('NIK')->nullable()->numeric(),
                        TextInput::make('tempat_lahir')->required(),
                        DatePicker::make('dob')->label('Tanggal lahir')->required(),
                        Select::make('jenis_kelamin')
                            ->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])
                            ->required(),
                        Select::make('gol_darah')
                            ->options(['A' => 'A', 'B' => 'B', 'AB' => 'AB', 'O' => 'O'])
                            ->nullable(),
                        TextInput::make('jml_saudara')->label('Jumlah saudara')->numeric()->nullable(),
                        TextInput::make('anak_ke')->label('Anak ke-')->numeric()->nullable(),
                        Textarea::make('alamat')->required()->columnSpanFull(),
                        TextInput::make('desa_kel')->label('Desa/kelurahan')->required(),
                        TextInput::make('kecamatan')->required(),
                        TextInput::make('kab_kota')->label('Kabupaten/kota')->required(),
                        TextInput::make('provinsi')->required(),
                        TextInput::make('negara')->default('Indonesia')->required(),
                        TextInput::make('kode_pos')->label('Kode pos')->nullable(),
                        TextInput::make('hobi')->nullable(),
                        TextInput::make('cita_cita')->label('Cita-cita')->nullable(),
                        TextInput::make('jml_hafalan')->label('Jumlah hafalan')->numeric()->nullable(),
                        Select::make('penanggung_jawab_biaya')
                            ->options(['Orang Tua' => 'Orang Tua', 'Lainnya' => 'Lainnya'])
                            ->required(),
                        TextInput::make('penanggung_lainnya')->label('Penanggung jawab lainnya')->nullable(),
                    ])
                    ->columns(3),

                // ✅ Section: Sekolah Asal
                Section::make('Sekolah Asal')
                    ->schema([
                        TextInput::make('sekolah')->label('Sekolah')->required(),
                        TextInput::make('npsn')->label('NPSN')->required(),
                        TextInput::make('tahun_lulus')->label('Tahun lulus')->numeric()->required(),
                        Textarea::make('alamat_sekolah')->label('Alamat')->nullable()->columnSpanFull(),
                        TextInput::make('desa_kel_sekolah')->label('Desa/kelurahan')->nullable(),
                        TextInput::make('kec_sekolah')->label('Kecamatan')->required(),
                        TextInput::make('kab_kota_sekolah')->label('Kabupaten/kota')->required(),
                        TextInput::make('prov_sekolah')->label('Provinsi')->nullable(),
                        TextInput::make('negara_sekolah')->label('Negara')->default('Indonesia')->nullable(),
                        TextInput::make('telepon_sekolah')->label('Telepon')->nullable(),
                    ])
                    ->columns(3),

                // ✅ Section: Data Ayah
                Section::make('Data Ayah')
                    ->schema([
                        TextInput::make('ayah_nama')->label('Nama')->required(),
                        TextInput::make('ayah_nik')->label('NIK')->required()->numeric(),
                        TextInput::make('ayah_tempat_lahir')->label('Tempat lahir')->required(),
                        DatePicker::make('ayah_dob')->label('Tanggal lahir')->required(),
                        TextInput::make('ayah_pekerjaan')->label('Pekerjaan')->required(),
                        Select::make('ayah_pend_terakhir')
                            ->label('Pendidikan terakhir')
                            ->options([
                                'SD' => 'SD',
                                'SMP' => 'SMP',
                                'SMA' => 'SMA',
                                'D1' => 'D1',
                                'D2' => 'D2',
                                'D3' => 'D3',
                                'S1' => 'S1',
                                'S2' => 'S2',
                                'S3' => 'S3',
                            ])->required(),
                        TextInput::make('ayah_jurusan')->label('Jurusan')->nullable(),
                        TextInput::make('ayah_no_hp')->label('No. HP')->tel()->required(),
                        TextInput::make('ayah_email')->label('Email')->email()->nullable(),
                        Select::make('ayah_status')
                            ->options(['Hidup' => 'Hidup', 'Wafat' => 'Wafat'])
                            ->label('Status')
                            ->required(),
                    ])
                    ->columns(3),

                // ✅ Section: Data Ibu
                Section::make('Data Ibu')
                    ->schema([
                        TextInput::make('ibu_nama')->label('Nama')->required(),
                        TextInput::make('ibu_nik')->label('NIK')->required()->numeric(),
                        TextInput::make('ibu_tempat_lahir')->label('Tempat lahir')->required(),
                        DatePicker::make('ibu_dob')->label('Tanggal lahir')->required(),
                        TextInput::make('ibu_pekerjaan')->label('Pekerjaan')->required(),
                        Select::make('ibu_pend_terakhir')
                            ->label('Pendidikan terakhir')
                            ->options([
                                'SD' => 'SD',
                                'SMP' => 'SMP',
                                'SMA' => 'SMA',
                                'D1' => 'D1',
                                'D2' => 'D2',
                                'D3' => 'D3',
                                'S1' => 'S1',
                                'S2' => 'S2',
                                'S3' => 'S3',
                            ])->required(),
                        TextInput::make('ibu_jurusan')->label('Jurusan')->nullable(),
                        TextInput::make('ibu_no_hp')->label('No. HP')->tel()->required(),
                        TextInput::make('ibu_email')->label('Email')->email()->nullable(),
                        Select::make('ibu_status')
                            ->label('Status')
                            ->options(['Hidup' => 'Hidup', 'Wafat' => 'Wafat'])
                            ->required(),
                    ])
                    ->columns(3),

                Section::make('Jenjang Tujuan')->schema([
                    Select::make('jenjang')
                        ->label('Jenjang')
                        ->options([
                            'Mutawassithah (MTw)' => 'Mutawassithah (MTw)',
                            'Idad Lughawy (IL)' => 'Idad Lughawy (IL)',
                            'Idad Mualimin (IM)' => 'Idad Mualimin (IM)',
                        ])
                        ->required(),

                    Select::make('kelas')
                        ->label('Kelas')
                        ->options([
                            'VII' => 'VII',
                            'VIII' => 'VIII',
                            'IX' => 'IX',
                            'X' => 'X',
                            'XI' => 'XI',
                            'XII' => 'XII',
                        ])
                        ->required(),
                ])->columns(2),

                Section::make('Tahapan Seleksi')
                    ->schema([
                        Checkbox::make('pendaftaran')->label('Pendaftaran'),
                        Checkbox::make('bayar_pendaftaran')->label('Bayar Pendaftaran'),
                        Checkbox::make('verifikasi_bayar_pendaftaran')->label('Verifikasi Bayar Pendaftaran'),
                        Checkbox::make('upload_berkas')->label('Upload Berkas'),
                        Checkbox::make('verifikasi_berkas')->label('Verifikasi Berkas'),
                        Checkbox::make('terima_undangan_ujian')->label('Terima Undangan Ujian Seleksi'),
                        Checkbox::make('ujian_seleksi')->label('Ujian Seleksi'),
                        Checkbox::make('bayar_daftar_ulang')->label('Bayar Daftar Ulang'),
                        Checkbox::make('verifikasi_daftar_ulang')->label('Verifikasi Daftar Ulang'),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc') // ✅ tambahin ini
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('kab_kota')
                    ->label('Kab/Kota')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('ayah_no_hp')
                    ->label('Ayah')
                    ->url(fn($record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->ayah_no_hp))
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn($state, $record) => $record->ayah_nama)
                    ->color('success'),

                Tables\Columns\TextColumn::make('ibu_no_hp')
                    ->label('Ibu')
                    ->url(fn($record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->ibu_no_hp))
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn($state, $record) => $record->ibu_nama)
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Reg Date')
                    ->dateTime('Y/m/d')
                    ->sortable(), // opsional aja kalo mau bisa diurut manual
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kab_kota')
                    ->label('Kab/Kota')
                    ->options(fn() => \App\Models\Santri::query()
                        ->pluck('kab_kota', 'kab_kota')
                        ->unique()
                        ->toArray()),

                Tables\Filters\SelectFilter::make('jenjang')
                    ->label('Jenjang')
                    ->options([
                        'Mutawassithah (MTw)' => 'Mutawassithah (MTw)',
                        'Idad Lughawy (IL)' => 'Idad Lughawy (IL)',
                        'Idad Mualimin (IM)' => 'Idad Mualimin (IM)',
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-m-eye')
                    ->iconButton(),

                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil-square')
                    ->iconButton(),

                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-m-trash')
                    ->iconButton(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('') // kosongin label
                    ->icon('heroicon-o-arrow-down-tray') // ikon download
                    ->tooltip('Export ke Excel') // tooltip waktu hover
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->label('Export to Excel')
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSantris::route('/'),
            'create' => Pages\CreateSantri::route('/create'),
            'edit' => Pages\EditSantri::route('/{record}/edit'),
            'view' => Pages\ViewSantri::route('/{record}'),
        ];
    }
}
