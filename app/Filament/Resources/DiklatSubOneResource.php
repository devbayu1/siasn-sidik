<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiklatSubOneResource\Pages;
use App\Filament\Resources\DiklatSubOneResource\RelationManagers;
use App\Models\DiklatSubOne;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiklatSubOneResource extends Resource
{
    protected static ?string $model = DiklatSubOne::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Sub Diklat';
    protected static ?string $pluralModelLabel = 'Sub Diklat';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('diklat_id')
                    ->label('Diklat')
                    ->relationship('diklat', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('name')
                    ->label('Nama Sub Diklat')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('diklat.name')
                    ->label('Diklat')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Sub Diklat')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah Sub Diklat')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->modalHeading('Ubah Sub Diklat'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDiklatSubOnes::route('/'),
        ];
    }
}
