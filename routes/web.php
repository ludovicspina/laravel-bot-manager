<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pm2Controller;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/pm2', [Pm2Controller::class, 'index']);
