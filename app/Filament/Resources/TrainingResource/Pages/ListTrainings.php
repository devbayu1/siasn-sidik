<?php

namespace App\Filament\Resources\TrainingResource\Pages;

use App\Filament\Resources\TrainingResource;
use Filament\Actions;
use Filament\Actions\Exports\Models\Export;
use Filament\Resources\Pages\ListRecords;

class ListTrainings extends ListRecords
{
    protected static string $resource = TrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pelatihan')
                ->icon('heroicon-o-plus-circle')
                ->color('primary'),
            Actions\ExportAction::make()
                ->label('Ekspor Data')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('secondary')
                ->modalHeading('Ekspor Data')
                ->successNotificationTitle('Data berhasil diekspor')
                ->fileName(fn(Export $export): string => "export-sertifikasi-{$export->getKey()}.csv")
                ->exporter(\App\Filament\Exports\TrainingExporter::class),
        ];
    }
}
