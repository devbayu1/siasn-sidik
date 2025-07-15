<?php

namespace App\Filament\Exports;

use App\Models\Employee;
use App\ReligionEnum;
use Carbon\Carbon;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class EmployeeExporter extends Exporter
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('pns_id')
                ->label('PNS ID'),
            ExportColumn::make('old_nip'),
            ExportColumn::make('nip'),
            ExportColumn::make('name')
                ->label('Nama'),
            ExportColumn::make('degree_prefix')
                ->label('Gelar Depan'),
            ExportColumn::make('degree_suffix')
                ->label('Gelar Belakang'),
            ExportColumn::make('national_id')
                ->label('NIK'),
            ExportColumn::make('birth_place')
                ->label('Tempat Lahir'),
            ExportColumn::make('birth_date')
                ->label('Tanggal Lahir')
                ->formatStateUsing(fn($state) => Carbon::parse($state)->format('d F Y')),
            ExportColumn::make('gender')
                ->label('Jenis Kelamin'),
            ExportColumn::make('religion')
                ->label('Agama')
                ->formatStateUsing(function ($state) {
                    if (is_string($state)) {
                        return ReligionEnum::fromString($state)->label();
                    }

                    if ($state instanceof ReligionEnum) {
                        return $state->label();
                    }

                    return '-';
                }),
            ExportColumn::make('phone'),
            ExportColumn::make('email'),
            ExportColumn::make('unit'),
            ExportColumn::make('institue.name')
                ->label('Instansi'),
            ExportColumn::make('education.name')
                ->label('Pendidikan'),
            ExportColumn::make('major.name')
                ->label('Jurusan'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your employee export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }


}
