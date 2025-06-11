<?php

use App\Filament\Resources\InfaqResource\Pages\ViewInfaqCustom;
use App\Models\Mosque;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
