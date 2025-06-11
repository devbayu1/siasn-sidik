<?php

namespace App\Filament\Resources\DiklatResource\Pages;

use App\Filament\Resources\DiklatResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDiklats extends ManageRecords
{
    protected static string $resource = DiklatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Diklat')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->modalHeading('Tambah Diklat Baru')
        ];
    }


}
