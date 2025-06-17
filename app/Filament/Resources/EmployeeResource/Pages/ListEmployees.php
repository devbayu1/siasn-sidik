<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pegawai')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->modalHeading('Tambah Pegawai'),
            ImportAction::make()
                ->label('Impor Pegawai')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->modalHeading('Impor Data Pegawai')
                ->successNotificationTitle('Data Pegawai berhasil diimpor')
                ->importer(\App\Filament\Imports\EmployeeImporter::class),
            ExportAction::make()
                ->label('Ekspor Pegawai')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('danger')
                ->modalHeading('Ekspor Data Pegawai')
                ->successNotificationTitle('Data Pegawai berhasil diekspor')
                ->exporter(\App\Filament\Exports\EmployeeExporter::class)
        ];
    }
}
