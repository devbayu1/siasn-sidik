<?php

use App\Filament\Resources\InfaqResource\Pages\ViewInfaqCustom;
use App\Models\Mosque;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Front\TrainingController;
use App\Http\Controllers\Front\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/training', [TrainingController::class, 'index'])->name('training');
// ... route Anda yang lain
Route::get('/get-sub-diklat/{diklat_id}', [TrainingController::class, 'getSubDiklats']);
Route::post('/training/store', [TrainingController::class, 'store'])->name('training.store'); // Contoh route untuk menyimpan
