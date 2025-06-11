<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingResource\Pages;
use App\Filament\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Employee;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationGroup = 'Sertifikasi & Pelatihan';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationLabel = 'Sertifikasi & Pelatihan';
    protected static ?string $pluralModelLabel = 'Sertifikasi & Pelatihan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->label('Pegawai')
                    ->options(Employee::all()->pluck('name', 'uuid'))
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('diklat_id')
                    ->label('Diklat')
                    ->relationship('diklat', 'name')
                    ->reactive()
                    ->searchable()
                    ->preload()
                    ->afterStateUpdated(fn(callable $set) => $set('diklat_sub_id', null))
                    ->required(),

                Forms\Components\Select::make('diklat_sub_id')
                    ->label('Sub Diklat')
                    ->searchable()
                    ->preload()
                    ->relationship('diklatSub', 'name')
                    ->visible(fn(callable $get) => \App\Models\Diklat::find($get('diklat_id'))?->subOnes()->exists()),

                Forms\Components\TextInput::make('training_name')
                    ->label('Nama Pelatihan')
                    ->required(),

                Forms\Components\TextInput::make('organizer')
                    ->label('Penyelenggara')
                    ->required(),
                Forms\Components\TextInput::make('certificate_number')
                    ->label('Nomor Sertifikat')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->required(),
                Forms\Components\Select::make('year')
                    ->label('Tahun')
                    ->options(
                        collect(range(now()->year, 2000))
                            ->mapWithKeys(fn($year) => [$year => $year])
                            ->toArray()
                    )
                    ->required(),
                Forms\Components\TextInput::make('duration_hours')
                    ->label('Durasi (Jam)')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\FileUpload::make('certificate_file')
                    ->label('File Sertifikat')
                    ->disk('public')
                    ->directory('certificates')
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                    ->maxSize(1024 * 5) // 5 MB
                    ->helperText('Unggah file sertifikat dalam format PDF, JPEG, atau PNG. Ukuran maksimal 5 MB.')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ])
                    ->default('pending')
                    ->reactive(),

                Forms\Components\Textarea::make('rejection_reason')
                    ->label('Alasan Penolakan')
                    ->helperText('Isi alasan penolakan jika status ditetapkan sebagai "Ditolak".')
                    ->visible(fn(callable $get) => $get('status') === 'rejected')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull()
                    ->helperText('Catatan tambahan terkait pengajuan ini.')
                    ->label('Catatan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Nama Pegawai')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('diklat.name')
                    ->label('Diklat')
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
                Tables\Columns\TextColumn::make('organizer')
                    ->label('Penyelenggara')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->label('Tanggal Mulai'),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->label('Tanggal Selesai'),
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun'),
                Tables\Columns\TextColumn::make('duration_hours')
                    ->label('Durasi (Jam)'),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'completed' => 'Selesai',
                    ])
                    ->label('Status'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Dibuat Pada'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Diperbarui Pada')



            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-eye')
                    ->color('primary'),
                Tables\Actions\EditAction::make()
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
            'view' => Pages\ViewTraining::route('/{record}'),
        ];
    }
}
