<?php

namespace App\Filament\Exports;

use App\Models\Employee;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Collection;

class RekapJamPelatihanExporter extends Exporter
{
    protected static ?string $model = Employee::class;

    public function getRecords(): Collection
    {
        $records = parent::getRecords();

        return $records->map(function ($record, $key) {
            $record->row_number = $key + 1;
            return $record;
        });
    }


    public static function getColumns(): array
    {
        return [
            ExportColumn::make('row_number')
                ->label('No'),

            ExportColumn::make('name')
                ->label('Nama'),

            ExportColumn::make('nip')
                ->label('NIP'),

            ExportColumn::make('unit')
            ->label('Jabatan'),

            ExportColumn::make('institute.name')
                ->label('Instansi'),

            ExportColumn::make('total_hours')
                ->label('Total Jam Pelatihan (JP)')
                ->state(function ($record) {
                    return $record->total_hours ?? 0;
                }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Ekspor rekapitulasi Anda berhasil dan ' . number_format($export->successful_rows) . ' ' . str('baris')->plural($export->successful_rows) . ' telah diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('baris')->plural($failedRowsCount) . ' gagal diekspor.';
        }

        return $body;
    }

    public function getFileName(Export $export): string
    {
        return "rekap-jam-pelatihan-" . now()->format('Y-m-d-His');
    }
}
