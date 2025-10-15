<?php

namespace App\Services\DataFetching\Providers;

use App\Services\DataFetching\Contracts\DataProviderInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class NewsApiProvider implements DataProviderInterface
{
    public function fetchData(): array
    {
        // Получаем API ключ из конфига
        $apiKey = config('aggregator.newsapi.key');

        //  GET-запрос к NewsAPI
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'country' => 'us', 
            'apiKey' => $apiKey,
        ]);


        if ($response->failed()) {
            //  здесь будет логирование ошибки
            return [];
        }


        return $response->json('articles', []);
    }
}
