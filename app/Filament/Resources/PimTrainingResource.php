<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PimTrainingResource\Pages;
use App\Models\Training;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class PimTrainingResource extends TrainingResource
{
    protected static ?string $model = Training::class;

    protected static ?string $slug = 'pim-trainings';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Barjas & PIM';

    protected static ?string $navigationLabel = 'Diklat PIM / Struktural';

    protected static ?string $pluralModelLabel = 'Diklat PIM / Struktural';

    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Nama Pegawai')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee.nip')
                    ->label('NIP')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('employee.institute.name')
                    ->label('Instansi')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->width('550px'),
                Tables\Columns\TextColumn::make('diklat.name')
                    ->label('Nama Diklat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('diklatSub.name')
                    ->label('Sub Diklat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('training_name')
                    ->label('Nama Pelatihan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_hours')
                    ->label('Duration Hours')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('diklat_sub_id')
                    ->label('Filter Sub Diklat')
                    ->relationship('diklatSub', 'name', fn (Builder $query) => 
                        $query->whereHas('diklat', fn ($q) => $q->where('name', 'Diklat Struktural'))
                    )
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(
                        collect(range(now()->year, 2000))
                            ->mapWithKeys(fn($year) => [$year => $year])
                            ->toArray()
                    ),
                Tables\Filters\Filter::make('month')
                    ->form([
                        Forms\Components\Select::make('month')
                            ->label('Bulan')
                            ->options([
                                '01' => 'Januari',
                                '02' => 'Februari',
                                '03' => 'Maret',
                                '04' => 'April',
                                '05' => 'Mei',
                                '06' => 'Juni',
                                '07' => 'Juli',
                                '08' => 'Agustus',
                                '09' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['month'],
                                fn (Builder $query, $date): Builder => $query->whereMonth('start_date', $date),
                            );
                    })
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('status', 'approved')
            ->whereHas('diklat', function (Builder $query) {
                $query->where('name', 'Diklat Struktural');
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPimTrainings::route('/'),
            'create' => Pages\CreatePimTraining::route('/create'),
            'edit' => Pages\EditPimTraining::route('/{record}/edit'),
            'view' => Pages\ViewPimTraining::route('/{record}'),
        ];
    }
}
