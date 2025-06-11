<?php

use App\Filament\Resources\InfaqResource\Pages\ViewInfaqCustom;
use App\Models\Mosque;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('frontend.home');
});
