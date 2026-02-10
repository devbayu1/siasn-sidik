<?php

namespace App\Filament\Resources\BarjasTrainingResource\Pages;

use App\Filament\Resources\BarjasTrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Exports\TrainingExport;
use Maatwebsite\Excel\Facades\Excel;

class ListBarjasTrainings extends ListRecords
{
    protected static string $resource = BarjasTrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('exportExcel')
                ->label('Export Excel')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    return Excel::download(
                        new TrainingExport($this->getFilteredTableQuery()), 
                        'laporan-diklat-barjas-' . now()->format('Y-m-d') . '.xlsx'
                    );
                }),
        ];
    }
}
