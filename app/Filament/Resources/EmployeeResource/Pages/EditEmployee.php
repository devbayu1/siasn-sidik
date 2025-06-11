<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;
    protected static ?string $title = 'Edit Pegawai';
    protected static ?string $navigationLabel = 'Edit Pegawai';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus Pegawai')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->modalHeading('Hapus Pegawai')
                ->successNotificationTitle('Pegawai berhasil dihapus'),
        ];
    }
}
