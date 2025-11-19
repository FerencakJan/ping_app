<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PingController;
use App\Models\Ping;

Route::post('/ping', [PingController::class, 'store']);

// jednoduchý výpis všetkých pingov
Route::get('/pings', function () {
    return Ping::all();
});
