<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StableController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('stables', StableController::class);
