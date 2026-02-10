<?php

namespace App\Filament\Resources\BarjasTrainingResource\Pages;

use App\Filament\Resources\BarjasTrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBarjasTraining extends ViewRecord
{
    protected static string $resource = BarjasTrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
