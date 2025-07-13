<?php

namespace App\Filament\Resources\EducationResource\Pages;

use App\Filament\Imports\EducationImporter;
use App\Filament\Resources\EducationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEducation extends ManageRecords
{
    protected static string $resource = EducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pendidikan')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->modalHeading('Tambah Pendidikan Baru'),
            Actions\ImportAction::make()
                ->label('Import Data')
                ->color('success')
                ->importer(EducationImporter::class)
        ];
    }
}
