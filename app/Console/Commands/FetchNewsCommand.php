<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DataFetching\Providers\NewsApiProvider; 

class FetchNewsCommand extends Command
{

    protected $signature = 'app:fetch-news';


    protected $description = 'Fetches news from the NewsAPI provider and displays them';


    public function handle(NewsApiProvider $newsApiProvider)
    {
        $this->info('Fetching news from NewsAPI...');

        // Вызываем метод из нашего провайдера
        $articles = $newsApiProvider->fetchData();

        if (empty($articles)) {
            $this->warn('No articles were fetched.');
            return;
        }

        $this->info('Successfully fetched ' . count($articles) . ' articles.');

        // Готовим данные для вывода в виде таблицы
        $displayData = [];
        foreach ($articles as $article) {
            $displayData[] = [
                'Source' => $article['source']['name'] ?? 'N/A',
                'Title' => $article['title'] ?? 'N/A',
                'URL' => $article['url'] ?? 'N/A',
            ];
        }

        // Выводим данные в терминал
        $this->table(['Source', 'Title', 'URL'], $displayData);
    }
}
