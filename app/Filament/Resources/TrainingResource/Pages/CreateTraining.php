<?php

namespace App\Filament\Resources\TrainingResource\Pages;

use App\Filament\Resources\TrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTraining extends CreateRecord
{
    protected static string $resource = TrainingResource::class;
    protected static ?string $title = 'Tambah Pengajuan Pelatihan';
    protected static ?string $navigationLabel = 'Tambah Pengajuan Pelatihan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pelatihan')
                ->icon('heroicon-o-plus-circle')
                ->color('primary'),
        ];
    }

    protected function getCreatedNotificationMessage(): ?string
    {
        return 'Data berhasil ditambahkan.';
    }
}
