<?php

namespace App\Filament\Resources\TrainingResource\Pages;

use App\Filament\Resources\TrainingResource;
use Filament\Actions;
use Filament\Actions\Exports\Models\Export;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

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
                ->color('primary')
                ->modalHeading('Ekspor Data')
                ->successNotificationTitle('Data berhasil diekspor')
                ->fileName(fn(Export $export): string => "export-sertifikasi-{$export->getKey()}.csv")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved'))
                ->exporter(\App\Filament\Exports\TrainingExporter::class),
        ];
    }
}
