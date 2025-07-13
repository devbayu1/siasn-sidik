<?php

namespace App\Filament\Imports;

use App\Models\Institute;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Validation\Rule;

class InstituteImporter extends Importer
{
    protected static ?string $model = Institute::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('institute_id')
                ->rules(fn ($record) => [
                    'max:255',
                    'required'
                ])
                ->ignoreBlankState(),
            ImportColumn::make('name')
                ->requiredMapping()
                ->fillRecordUsing(function (Institute $record, string $state): void {
                    if(blank($state) || $state == ''){
                        $record->name = 'Undefined Name';
                    }else{
                        $record->name = $state;
                    }
                })
                ->rules(['required', 'max:255'])
        ];
    }

    public function resolveRecord(): ?Institute
    {
         return Institute::firstOrNew([
             'institute_id' => $this->data['institute_id'],
         ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your institute import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
