<?php

namespace App\Services\DataFetching\Providers;

use App\Services\DataFetching\Contracts\DataProviderInterface;
use Illuminate\Support\Facades\Http;

class WeatherApiProvider implements DataProviderInterface
{
    public function fetchData(): array
    {
        $apiKey = config('aggregator.openweathermap.key');
        
        $city = 'Almaty';

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric', 
            'lang' => 'ru',     
        ]);

 
        if ($response->failed()) {

            return [];
        }

        return [ $response->json() ];
    }
}
