<?php

namespace App\Filament\Widgets;

use App\Models\Santri;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card; // ✅ INI VERSI AMAN BUAT INTELEPHENSE

class SeleksiStats extends BaseWidget
{
    protected function getCards(): array
    {
        $total = Santri::count();

        return [
            Card::make('Bayar Pendaftaran', Santri::where('bayar_pendaftaran', true)->count() . ' / ' . $total)
                ->description($this->persen(Santri::where('bayar_pendaftaran', true)->count(), $total) . ' sudah bayar')
                ->color('success'),

            Card::make('Upload Berkas', Santri::where('upload_berkas', true)->count() . ' / ' . $total)
                ->description($this->persen(Santri::where('upload_berkas', true)->count(), $total) . ' sudah upload'),

            Card::make('Ujian Seleksi', Santri::where('ujian_seleksi', true)->count() . ' / ' . $total)
                ->description($this->persen(Santri::where('ujian_seleksi', true)->count(), $total) . ' sudah ikut'),

            Card::make('Bayar Daftar Ulang', Santri::where('bayar_daftar_ulang', true)->count() . ' / ' . $total)
                ->description($this->persen(Santri::where('bayar_daftar_ulang', true)->count(), $total) . ' sudah daftar ulang'),
        ];
    }

    private function persen($jumlah, $total): string
    {
        return $total > 0 ? round(($jumlah / $total) * 100, 1) . '%' : '0%';
    }
}