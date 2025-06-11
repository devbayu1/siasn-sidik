<?php

namespace App\Filament\Resources\DiklatSubOneResource\Pages;

use App\Filament\Resources\DiklatSubOneResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDiklatSubOnes extends ManageRecords
{
    protected static string $resource = DiklatSubOneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Sub Diklat')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->modalHeading('Tambah Sub Diklat Baru'),
        ];
    }
}
