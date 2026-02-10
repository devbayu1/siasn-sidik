<?php

namespace App\Filament\Resources\BarjasTrainingResource\Pages;

use App\Filament\Resources\BarjasTrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarjasTraining extends EditRecord
{
    protected static string $resource = BarjasTrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
