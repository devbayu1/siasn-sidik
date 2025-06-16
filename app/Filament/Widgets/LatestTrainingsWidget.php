<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Employee;
use App\Models\Institute;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\RekapJamPelatihanExporter; // <-- 1. Import Exporter
use Filament\Tables\Actions\ExportAction; // <-- 2. Import ExportAction


class LatestTrainingsWidget extends BaseWidget
{
    protected static ?string $heading = 'Rekapitulasi Jam Pelatihan per Pegawai';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 4;

    protected function getTableFiltersFormColumns(): int
    {
        return 3;
    }

    public function updatedTableFilters(): void
    {
        $this->resetPage();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $selectedYear = $this->tableFilters['year']['value'] ?? null;
                $selectedMonth = $this->tableFilters['month']['value'] ?? null;

                $query = Employee::query()
                    ->with('institute')
                    // Bagian ini sudah benar, hanya menjumlahkan jam dari pelatihan yang 'approved'.
                    ->withSum(['trainings as total_hours' => function (Builder $query) use ($selectedYear, $selectedMonth) {
                        $query->where('status', 'approved'); // Filter untuk kalkulasi SUM
                        if ($selectedYear) {
                            $query->whereYear('start_date', $selectedYear);
                        }
                        if ($selectedMonth) {
                            $query->whereMonth('start_date', $selectedMonth);
                        }
                    }], 'duration_hours')


                    ->whereHas('trainings', function (Builder $subQuery) use ($selectedYear, $selectedMonth) {
                        $subQuery->where('status', 'approved');

                        if ($selectedYear) {
                            $subQuery->whereYear('start_date', $selectedYear);
                        }
                        if ($selectedMonth) {
                            $subQuery->whereMonth('start_date', $selectedMonth);
                        }
                    })
                    ->orderBy('total_hours', 'desc');

                return $query;
            })
            ->headerActions([
                ExportAction::make()
                    ->label('Ekspor Excel')
                    ->color('primary')
                    ->exporter(RekapJamPelatihanExporter::class)
            ])
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),

                Tables\Columns\TextColumn::make('unit')
                    ->label('Jabatan')
                    ->searchable()
                    ->wrap()
                    ->extraAttributes([
                        'style' => 'max-width: 200px'
                    ]),

                Tables\Columns\TextColumn::make('institute.name')
                    ->label('Instansi')
                    ->wrap()
                    ->extraAttributes([
                        'style' => 'max-width: 200px'
                    ]),

                Tables\Columns\TextColumn::make('total_hours')
                    ->label('Total Jam Pelatihan (JP)')
                    ->numeric()
                    ->default(0)
                    ->badge()
                    ->color(fn ($state): string => match (true) {
                        $state >= 24 => 'primary',
                        $state <= 23 => 'warning',
                        default => 'success',
                    })
                    ->extraAttributes([
                        'style' => 'max-width: 180px'
                    ]),
            ])
            ->filters([
                SelectFilter::make('institute_id')
                    ->label('Instansi')
                    ->options(Institute::all()->pluck('name', 'id'))
                    ->searchable(),

                SelectFilter::make('year')->label('Tahun')
                    ->options(fn (): array => array_combine($years = range(date('Y'), date('Y') - 5), $years))
                    ->query(fn (Builder $query, array $data): Builder => $query),

                SelectFilter::make('month')->label('Bulan')
                    ->options([
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query),
            ]);
    }
}
