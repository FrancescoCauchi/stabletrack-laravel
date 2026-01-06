<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StableController;
use App\Http\Controllers\HorseController;
use App\Http\Controllers\HorseStatusController;

Route::get('/', function () {
    return redirect()->route('stables.index');
});

Route::resource('stables', StableController::class);
Route::resource('horses', HorseController::class);
Route::resource('statuses', HorseStatusController::class)->except(['show']);
