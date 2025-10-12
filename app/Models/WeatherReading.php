<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'city',
        'temperature',
        'pressure',
        'humidity',
        'wind_speed',
        'description',
    ];


    protected $casts = [
        'temperature' => 'decimal:2',
        'wind_speed' => 'decimal:2',
    ];
}
