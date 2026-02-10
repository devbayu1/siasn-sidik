<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarjasTrainingResource\Pages;
use App\Models\Training;
use App\Models\Diklat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BarjasTrainingResource extends TrainingResource
{
    protected static ?string $model = Training::class;

    protected static ?string $slug = 'barjas-trainings';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Barjas & PIM';

    protected static ?string $navigationLabel = 'Diklat Barang Jasa';

    protected static ?string $pluralModelLabel = 'Diklat Barang Jasa';

    protected static ?int $navigationSort = 1;

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
            ->whereHas('diklat', function (Builder $query) {
                $query->where('name', 'like', '%Barang Jasa%');
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarjasTrainings::route('/'),
            'create' => Pages\CreateBarjasTraining::route('/create'),
            'edit' => Pages\EditBarjasTraining::route('/{record}/edit'),
            'view' => Pages\ViewBarjasTraining::route('/{record}'),
        ];
    }
}
