<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\WeatherReading; 
use Illuminate\Http\Request;

class WeatherController extends Controller
{
   
    public function index()
    {
        
        $latestWeather = WeatherReading::latest()->first();

        
        return response()->json([
            'status' => 'success',
            'data' => $latestWeather,
        ]);
    }
} 