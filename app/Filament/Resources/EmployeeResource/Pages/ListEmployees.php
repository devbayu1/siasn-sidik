<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Actions\ExportAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;
use Maatwebsite\Excel\Facades\Excel;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Pegawai')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->modalHeading('Tambah Pegawai'),
//            ImportAction::make()
//                ->label('Impor Pegawai')
//                ->icon('heroicon-o-arrow-down-tray')
//                ->color('success')
//                ->modalHeading('Impor Data Pegawai')
//                ->successNotificationTitle('Data Pegawai berhasil diimpor')
//                ->importer(\App\Filament\Imports\EmployeeImporter::class)
//                ->chunkSize(1000),
            Actions\Action::make('Import Data')
                ->color('success')
                ->modalDescription(function (){
                    return new HtmlString(
                        'Mohon gunakan format dengan benar, <a href="/storage/PNS_FORMAT.xlsx" target="_blank" class="text-primary underline">download format disini</a>'
                    );
                })
                ->form([
                    FileUpload::make('xlsxFile')
                        ->label('XLSX File')
                        ->disk('local')
                        ->required()
                        ->directory('imports'),
                ])->action(function (array $data) {
                    if ($data['xlsxFile'] !== null) {
                        $filePath = $data['xlsxFile'];
                        Excel::queueImport(new EmployeeImport(), $filePath);
                        Notification::make()->success()->title('Data starting import')->body('Please wait until done, or monitoring using job monitor menu')->send();
                    }
                }),
            ExportAction::make()
                ->label('Ekspor Pegawai')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('danger')
                ->modalHeading('Ekspor Data Pegawai')
                ->successNotificationTitle('Data Pegawai berhasil diekspor')
                ->exporter(\App\Filament\Exports\EmployeeExporter::class)
        ];
    }
}
