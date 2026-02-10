<?php

namespace App\Filament\Resources\PimTrainingResource\Pages;

use App\Filament\Resources\PimTrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPimTraining extends EditRecord
{
    protected static string $resource = PimTrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
