<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Entities;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntitiesController;
use App\Http\Controllers\DocumentarySeriesController;
use App\Http\Controllers\UploadFileController;
use App\Models\DocumentarySeries;
use App\Models\UploadFile;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [UploadFileController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function(){
   Route::resource('entidades', EntitiesController::class);
   Route::resource('series_documentales',DocumentarySeriesController::class);
   Route::resource('upload_files',UploadFileController::class);
});

Route::middleware(['auth'])->group(function(){
   Route::post('sub_series/{serie}', [DocumentarySeriesController::class,'sub_carpeta'])->name('sub_carpeta');
   Route::put('sub_series/{serie}', [DocumentarySeriesController::class,'sub_editar'])->name('sub_editar');



});


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

