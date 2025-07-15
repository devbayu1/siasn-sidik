<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\Major;
use App\ReligionEnum;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Pegawai';
    protected static ?string $pluralModelLabel = 'Pegawai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('pns_id')->required()->unique(ignoreRecord: true)->label('ID (SIASN)'),
                    TextInput::make('nip')->required()->unique(ignoreRecord: true)->label('NIP'),
                    TextInput::make('old_nip')->label('NIP Lama')
                        ->helperText('NIP Lama, jika ada. Kosongkan jika tidak ada.')
                        ->unique(ignoreRecord: true),
                    TextInput::make('name')->required()->label('Nama Pegawai'),
                    TextInput::make('degree_prefix')->label('Gelar Depan'),
                    TextInput::make('degree_suffix')->label('Gelar Belakang'),
                    TextInput::make('national_id')->label('NIK')->required()->unique(ignoreRecord: true)
                        ->helperText('Nomor Induk Kependudukan, harus unik. Kosongkan jika tidak ada.'),

                    TextInput::make('birth_place')->required()->label('Tempat Lahir'),
                    DatePicker::make('birth_date')->required()->label('Tanggal Lahir')
                        ->displayFormat('d F Y')
                        ->placeholder('Pilih Tanggal Lahir'),

                    Select::make('gender')
                        ->options([
                            'MALE' => 'Male',
                            'FEMALE' => 'Female',
                        ])
                        ->required()->label('Jenis Kelamin')
                        ->native(false),

                    Select::make('religion')
                        ->label('Agama ')
                        ->options(ReligionEnum::options())
                        ->required()
                        ->native(false),
                    TextInput::make('phone')->tel()
                        ->label('Telepon')
                        ->helperText('Nomor telepon pegawai, bisa kosong jika tidak ada.'),
                    TextInput::make('email')->email()
                        ->label('Email')
                        ->helperText('Email pegawai, bisa kosong jika tidak ada.'),

                    TextInput::make('unit')->label('Unit Kerja')
                        ->helperText('Unit kerja pegawai, bisa kosong jika tidak ada.'),

                    Select::make('institute_id')
                        ->label('Instansi')
                        ->relationship('institute', 'name')
                        ->preload(),

                    Select::make('education_id')
                        ->label('Pendidikan')
                        ->relationship('education', 'name')
                        ->searchable()
                        ->preload(),

                    Select::make('major_id')
                        ->label('Jurusan')
                        ->relationship('major', 'name')
                        ->getOptionLabelFromRecordUsing(fn (Major $record) => "{$record->name} {$record->major_id}")
                        ->searchable(['major_id', 'name'])
                        ->preload(),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nip')->searchable()->sortable()->label('NIP'),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->label('Nama Pegawai'),
                Tables\Columns\TextColumn::make('gender')->label('Jenis Kelamin'),
                Tables\Columns\TextColumn::make('religion')->label('Agama'),
                Tables\Columns\TextColumn::make('education.name')->label('Pendidikan'),
                Tables\Columns\TextColumn::make('major.name')->label('Jurusan'),
                Tables\Columns\TextColumn::make('institute.name')->label('Instansi'),
            ])
            ->defaultSort('name')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
