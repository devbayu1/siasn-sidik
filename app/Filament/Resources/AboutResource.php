<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Website Management';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Tentang Kami';
    protected static ?string $pluralModelLabel = 'Tentang Kami';
    protected static ?string $modelLabelPlural = 'Tentang Kami';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('icon')
                    ->required()
                    ->label('Bootstrap Icon Class')
                    ->helperText('Contoh: bi bi-code-slash, bi bi-house, bi bi-gear, ambil dari https://icons.getbootstrap.com/')
                    ->placeholder('Contoh: bi-code-slash'),
                Forms\Components\TextInput::make('title')->label('Judul')->required(),
                Forms\Components\Textarea::make('description')->label('Deskripsi')
                    ->nullable()
                    ->maxLength(500)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable(),
                Tables\Columns\TextColumn::make('icon'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ManageAbouts::route('/'),
        ];
    }
}
