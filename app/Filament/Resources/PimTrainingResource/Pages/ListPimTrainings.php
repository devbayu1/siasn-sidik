<?php

namespace App\Filament\Resources\PimTrainingResource\Pages;

use App\Filament\Resources\PimTrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Exports\TrainingExport;
use Maatwebsite\Excel\Facades\Excel;

class ListPimTrainings extends ListRecords
{
    protected static string $resource = PimTrainingResource::class;

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
                        'laporan-diklat-pim-' . now()->format('Y-m-d') . '.xlsx'
                    );
                }),
        ];
    }
}
