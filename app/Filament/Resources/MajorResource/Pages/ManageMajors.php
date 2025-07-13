<?php

namespace App\Filament\Resources\MajorResource\Pages;

use App\Filament\Imports\MajorImporter;
use App\Filament\Resources\MajorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMajors extends ManageRecords
{
    protected static string $resource = MajorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Jurusan')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->modalHeading('Tambah Jurusan Baru'),
            Actions\ImportAction::make()->label('Import Data')
                ->color('success')
                ->importer(MajorImporter::class)
        ];
    }
}
