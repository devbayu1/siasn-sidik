<?php

namespace App\Filament\Resources\ConversionTableResource\Pages;

use App\Filament\Resources\ConversionTableResource;
use App\Models\Media;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageConversionTables extends ManageRecords
{
    protected static string $resource = ConversionTableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
