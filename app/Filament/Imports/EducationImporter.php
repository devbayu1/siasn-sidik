<?php

namespace App\Filament\Imports;

use App\Models\Education;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class EducationImporter extends Importer
{
    protected static ?string $model = Education::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('education_id')
                ->rules(fn ($record) => [
                    'max:255',
                    'required'
                ])
                ->ignoreBlankState(),
            ImportColumn::make('name')
                ->requiredMapping()
                ->fillRecordUsing(function (Education $record, string $state): void {
                    if(blank($state) || $state == ''){
                        $record->name = 'Undefined Name';
                    }else{
                        $record->name = $state;
                    }
                })
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Education
    {
         return Education::firstOrNew([
             'education_id' => $this->data['education_id'],
         ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your education import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
