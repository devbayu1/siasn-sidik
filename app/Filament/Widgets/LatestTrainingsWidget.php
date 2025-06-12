<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Employee;

class LatestTrainingsWidget extends BaseWidget
{
    protected static ?string $heading = 'Rekapitulasi Jam Pelatihan per Pegawai';

    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 4; // Urutan widget, letakkan setelah tabel sebelumnya


    public function table(Table $table): Table
    {
        return $table
            // 2. Query untuk mengambil dan menjumlahkan data
            ->query(
                Employee::query()
                    ->with('institute') // Eager load instansi untuk ditampilkan
                    // INI BAGIAN UTAMA-nya:
                    // Menjumlahkan kolom 'duration_hours' dari relasi 'trainings'
                    // dan menyimpannya dalam properti baru bernama 'total_hours'
                    ->withSum('trainings as total_hours', 'duration_hours')
                    // Urutkan berdasarkan total jam terbanyak
                    ->orderBy('total_hours', 'desc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pegawai')
                    ->searchable(),

                Tables\Columns\TextColumn::make('institute.name')
                    ->label('Instansi')
                    ->badge()
                    ->searchable(),

                // 3. Tampilkan kolom hasil penjumlahan
                Tables\Columns\TextColumn::make('total_hours')
                    ->label('Total Jam Pelatihan (JP)')
                    ->numeric() // Ratakan ke kanan karena ini angka
                    ->sortable() // Buat kolom ini bisa di-sort
                    ->default(0) // Tampilkan 0 jika pegawai belum ada pelatihan
                    ->badge() // <-- 1. Ubah tampilan menjadi 'badge' (blok)
                    ->color(fn ($state): string => match (true) { // <-- 2. Terapkan logika warna
                        $state >= 24 => 'primary', // Jika lebih dari 24, warna primary
                        $state <= 23 => 'warning', // Jika di bawah 23, warna warning
                        default => 'success',   // Untuk nilai 23 dan 24, warna success
                    }),

            ])
            ->paginated(true); // Opsional: matikan paginasi jika ingin menampilkan semua

    }
}
