<?php

namespace App\Filament\Exports;

use App\Models\Training;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Carbon;

class TrainingExporter extends Exporter
{
    protected static ?string $model = Training::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('employee_id')
                ->label('ID Pegawai'),
            ExportColumn::make('employee.name')
                ->label('Nama Pegawai'),
            ExportColumn::make('diklat_id')
                ->label('ID Jenis Diklat'),
            ExportColumn::make('diklat.name')
                ->label('Nama Diklat'),
            ExportColumn::make('diklat_sub_id')
                ->label('ID Diklat Struktural'),
            ExportColumn::make('diklatSub.name')
                ->label('Jenis Diklat Struktural'),
            ExportColumn::make('training_name')
                ->label('Nama Pelatihan'),
            ExportColumn::make('organizer')
                ->label('Penyelenggara'),
            ExportColumn::make('certificate_number')
                ->label('Nomor Sertifikat'),
            ExportColumn::make('start_date')
                ->label('Tanggal Mulai')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d F Y')),
            ExportColumn::make('end_date')
                ->label('Tanggal Selesai')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d F Y')),
            ExportColumn::make('year')
                ->label('Tahun Pelatihan'),
            ExportColumn::make('duration_hours')
                ->label('Durasi (Jam)'),
            ExportColumn::make('created_at')
                ->label('Tanggal Dibuat')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d F Y H:i:s')),
            ExportColumn::make('updated_at')
                ->label('Tanggal Diperbarui')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d F Y H:i:s')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your training export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
