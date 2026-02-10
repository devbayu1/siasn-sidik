<?php

namespace App\Filament\Resources\PimTrainingResource\Pages;

use App\Filament\Resources\PimTrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPimTraining extends ViewRecord
{
    protected static string $resource = PimTrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
