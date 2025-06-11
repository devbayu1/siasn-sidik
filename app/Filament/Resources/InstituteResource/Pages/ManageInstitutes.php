<?php

namespace App\Filament\Resources\InstituteResource\Pages;

use App\Filament\Resources\InstituteResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageInstitutes extends ManageRecords
{
    protected static string $resource = InstituteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Instansi')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->modalHeading('Tambah Instansi Baru'),
        ];
    }
}
