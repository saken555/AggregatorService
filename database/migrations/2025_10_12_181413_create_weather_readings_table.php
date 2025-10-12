<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weather_readings', function (Blueprint $table) {
            $table->id();
            $table->string('source'); // Источник данных (например, 'openweathermap')
            $table->string('city');   // Город, для которого получены данные
            $table->decimal('temperature', 5, 2); // Температура, например, 25.55
            $table->unsignedInteger('pressure'); // Давление в гПа
            $table->unsignedInteger('humidity'); // Влажность в %
            $table->decimal('wind_speed', 5, 2); // Скорость ветра
            $table->string('description'); // Описание (например, 'ясно', 'небольшой дождь')
            $table->timestamps(); // Поля created_at и updated_at
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('weather_readings');
    }
};
