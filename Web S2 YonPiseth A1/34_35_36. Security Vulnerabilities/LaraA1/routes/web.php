<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/submit-data', [\App\Http\Controllers\Controller::class, 'submitData']);
