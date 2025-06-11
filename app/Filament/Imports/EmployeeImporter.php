<?php

namespace App\Filament\Imports;

use App\Models\Employee;
use App\ReligionEnum;
use Carbon\Carbon;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class EmployeeImporter extends Importer
{
    protected static ?string $model = Employee::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('old_nip')
                ->rules(['max:255']),
            ImportColumn::make('nip')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('degree_prefix')
                ->rules(['max:255']),
            ImportColumn::make('degree_suffix')
                ->rules(['max:255']),
            ImportColumn::make('national_id')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('birth_place')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('birth_date')
                ->requiredMapping()
                ->helperText('Format: YYYY-MM-DD')
                ->fillRecordUsing(function (Employee $record, string $state): void {
                    $record->birth_date = Carbon::parse($state ?? now())->format('Y-m-d');
                })
                ->rules(['required', 'date']),
            ImportColumn::make('gender')
                ->requiredMapping()
                ->rules(['required'])
                ->examples(['MALE', 'FEMALE'])
                ->helperText('MALE/FEMALE'),
            ImportColumn::make('religion')
                ->requiredMapping()
                ->rules(['required', 'max:255'])
                ->helperText('Islam, Kristen, Katolik, Hindu, Buddha, Khonghucu')
                ->examples(ReligionEnum::options()),
            ImportColumn::make('phone')
                ->rules(['max:255']),
            ImportColumn::make('email')
                ->rules(['max:255']),
            ImportColumn::make('unit')
                ->rules(['max:255']),
            ImportColumn::make('institute_id')
                ->numeric()
                ->relationship('institute', 'id')
                ->rules(['integer']),
            ImportColumn::make('education_id')
                ->numeric()
                ->relationship('education', 'id')
                ->rules(['integer']),
            ImportColumn::make('major_id')
                ->relationship('major', 'id')
                ->numeric()
                ->rules(['integer']),
        ];
    }

    public function resolveRecord(): ?Employee
    {
        // return Employee::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Employee();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your employee import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    public static function getFailedNotificationBody(Import $import): string
    {
        return 'Your employee import has failed. Please check the error log for details.';
    }
    public static function getFailedNotificationTitle(Import $import): string
    {
        return 'Employee Import Failed';
    }
    public static function getCompletedNotificationTitle(Import $import): string
    {
        return 'Employee Import Completed';
    }
    public static function getSuccessNotificationTitle(Import $import): string
    {
        return 'Employee Import Successful';
    }
    public static function getSuccessNotificationBody(Import $import): string
    {
        return 'Your employee import has been successfully processed.';
    }
}
