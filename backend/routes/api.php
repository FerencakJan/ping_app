<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PingController;

Route::post('/ping', [PingController::class, 'store']);
