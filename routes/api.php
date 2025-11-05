<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\NewsController; 
use App\Http\Controllers\Api\V1\WeatherController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/v1/news', [NewsController::class, 'index']);

Route::get('/v1/weather', [WeatherController::class, 'index']);