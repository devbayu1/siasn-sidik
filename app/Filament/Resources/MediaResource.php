<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Filament\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Website Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->label('Title'),

                Forms\Components\Select::make('type')
                    ->options([
                        'video' => 'Video',
                        'image' => 'Image',
                        'document' => 'Document',
                        'audio' => 'Audio',
                    ])
                    ->required()
                    ->label('Type'),

                Forms\Components\Textarea::make('description')
                    ->nullable()
                    ->label('Deskripsi')
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->label('Description'),

                Forms\Components\FileUpload::make('file_path')
                    ->required()
                    ->acceptedFileTypes(['image/*', 'video/*', 'application/pdf', 'audio/*'])
                    ->maxSize(2048) // 2MB
                    ->columnSpanFull()
                    ->disk('public')
                    ->directory('media')
                    ->label('File'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->sortable(),

                Tables\Columns\TextColumn::make('file_path')
                    ->label('File Path')
                    ->url(fn (Media $record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ManageMedia::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('slug','!=' ,'tabel-konversi');
    }
}
