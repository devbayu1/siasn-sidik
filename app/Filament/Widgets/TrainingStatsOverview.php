<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use App\Models\Training;
use App\Models\Diklat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class TrainingStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $year = Carbon::now()->year;

        return [
            Stat::make('Total Pegawai', Employee::count())
                ->description('Jumlah seluruh pegawai')
                ->icon('heroicon-o-users')
                ->color('primary'),

            Stat::make('Total Riwayat Diklat', Training::count())
                ->description('Seluruh entri pelatihan')
                ->icon('heroicon-o-clipboard-document-check')
                ->color('warning'),

            Stat::make('Jumlah Jenis Diklat', Diklat::count())
                ->description('Tipe diklat tersedia')
                ->icon('heroicon-o-clipboard-document')
                ->color('info'),

            Stat::make("Pegawai Ikut Diklat $year", Training::whereYear('start_date', $year)->distinct('employee_id')->count('employee_id'))
                ->description("Pegawai ikut diklat tahun $year")
                ->color('success')
                ->icon('heroicon-o-academic-cap'),

            Stat::make('Total Jam Pelatihan (Tahun Ini)', Training::whereYear('start_date', Carbon::now()->year)->sum('duration_hours') . ' JP')
                ->description('Akumulasi jam pelatihan di tahun ' . Carbon::now()->year)
                ->color('primary')
                ->icon('heroicon-o-clock'),
        ];
    }
}
