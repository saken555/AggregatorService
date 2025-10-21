<?php

namespace App\Console\Commands;

use App\Models\WeatherReading; 
use Illuminate\Console\Command;
use App\Services\DataFetching\Providers\WeatherApiProvider; 

class FetchWeatherCommand extends Command
{
    protected $signature = 'app:fetch-weather';
    protected $description = 'Fetches current weather from OpenWeatherMap and saves it to the database';

    public function handle(WeatherApiProvider $weatherApiProvider)
    {
        $this->info('Fetching weather from OpenWeatherMap...');
        
        $data = $weatherApiProvider->fetchData();

        if (empty($data) || !isset($data[0])) {
            $this->warn('No weather data was fetched.');
            return;
        }

        $weatherData = $data[0];

        try {
            
            WeatherReading::create([
                'source' => 'openweathermap',
                'city' => $weatherData['name'],
                'temperature' => $weatherData['main']['temp'],
                'pressure' => $weatherData['main']['pressure'],
                'humidity' => $weatherData['main']['humidity'],
                'wind_speed' => $weatherData['wind']['speed'],
                'description' => $weatherData['weather'][0]['description'] ?? 'N/A',
            ]);

            $this->info("Successfully saved weather for {$weatherData['name']}.");
        
        } catch (\Exception $e) {
            $this->error('Failed to save weather data: ' . $e->getMessage());
        }
    }
}
