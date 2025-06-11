<?php

namespace App\Filament\Resources\TrainingResource\Pages;

use App\Filament\Resources\TrainingResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\EditAction;

class ViewTraining extends ViewRecord
{
    protected static string $resource = TrainingResource::class;
    protected static ?string $navigationLabel = 'Detail Pengajuan Pelatihan';
    protected static ?string $title = 'Detail Pengajuan Pelatihan';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label('Ubah Peengajuan Pelatihan')
                ->icon('heroicon-o-pencil-square')
                ->color('primary'),
        ];
    }

    // protected function getViewData(): array
    // {
    //     return [
    //         'training' => $this->record,
    //     ];
    // }

    protected function getViewHeader(): string
    {
        return 'Detail Pengajuan Pelatihan';
    }

    public  function getView(): string
    {
        return 'filament.resources.training-resource.pages.view-training';
    }
}
