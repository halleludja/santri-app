<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use App\Models\Santri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Support\Enums\IconSize;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('santri_id')
                    ->label('Santri ID')
                    ->options(function () {
                        return \App\Models\Santri::all()->pluck('nama', 'id'); // ID = value, Nama = label
                    })
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('date')
                    ->label('Tanggal Pembayaran')
                    ->required(),

                Select::make('payment')
                    ->label('Jenis Pembayaran')
                    ->options([
                        'Pendaftaran' => 'Pendaftaran',
                        'Uang Pangkal' => 'Uang Pangkal',
                        'SPP' => 'SPP',
                        'Makan/Katering' => 'Makan/Katering',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->required(),

                TextInput::make('jumlah')
                    ->label('Jumlah Pembayaran')
                    ->numeric()
                    ->required(),

                Textarea::make('desc')
                    ->label('Keterangan')
                    ->nullable(),

                Toggle::make('is_recurring')
                    ->label('Pembayaran Berkala (Recurring)?')
                    ->inline(false),

                FileUpload::make('proof')
                    ->label('Bukti Pembayaran')
                    ->disk('public') // ini penting!
                    ->directory('payments') // folder dalam /storage/app/public
                    ->preserveFilenames()
                    ->previewable(true)
                    ->openable()
                    ->required()
                    ->downloadable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('date')
                    ->label('Tanggal')
                    ->dateTime('Y/m/d')
                    ->sortable(),

                TextColumn::make('santri.nama') // relasi ke model Santri
                    ->label('Nama Santri')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment')
                    ->label('Jenis Pembayaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pendaftaran' => 'success',
                        'Uang Pangkal' => 'warning',
                        'SPP' => 'info',
                        'Makan/Katering' => 'primary',
                        'Lainnya' => 'gray',
                        default => 'secondary',
                    }),

                TextColumn::make('jumlah')
                    ->label('Nominal')
                    ->money('IDR', true)
                    ->sortable(),

                IconColumn::make('proof')
                    ->label('Bukti Pembayaran')
                    ->icon(fn($record) => match (pathinfo($record->proof ?? '', PATHINFO_EXTENSION)) {
                        'pdf' => 'heroicon-o-document-text',
                        'jpg', 'jpeg', 'png' => 'heroicon-o-photo',
                        default => 'heroicon-o-document',
                    })
                    ->color('gray')
                    ->tooltip(fn($record) => $record->proof ? 'Klik untuk download: ' . basename($record->proof) : 'Belum ada file')
                    ->url(fn($record) => $record->proof ? route('download.proof', basename($record->proof)) : null)
                    ->openUrlInNewTab(),
            ])
            ->filters([
                Tables\Filters\Filter::make('id')
                    ->form([
                        TextInput::make('id'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['id'], fn($q) => $q->where('id', $data['id']));
                    }),

                Tables\Filters\SelectFilter::make('jenjang')
                    ->label('Jenjang')
                    ->options([
                        'Mutawassithah' => 'Mutawassithah',
                        'Idad Lughawy' => 'Idad Lughawy',
                        'Idad Mualimin' => 'Idad Mualimin',
                    ]),

                Tables\Filters\SelectFilter::make('payment')
                    ->label('Jenis Pembayaran')
                    ->options([
                        'Pendaftaran' => 'Pendaftaran',
                        'Uang Pangkal' => 'Uang Pangkal',
                        'SPP' => 'SPP',
                        'Makan/Katering' => 'Makan/Katering',
                        'Lainnya' => 'Lainnya',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-m-eye')
                    ->iconButton(),

                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil-square')
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
