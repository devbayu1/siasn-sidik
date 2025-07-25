<?php

namespace App\Filament\Imports;

use App\Models\Major;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class MajorImporter extends Importer
{
    protected static ?string $model = Major::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('major_id')
                ->rules(['max:255']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Major
    {
         return Major::firstOrNew([
             'major_id' => $this->data['major_id'],
         ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your major import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
