<?php

namespace App\Console\Commands;

use App\Models\NewsArticle; 
use Illuminate\Console\Command;
use App\Services\DataFetching\Providers\NewsApiProvider;

class FetchNewsCommand extends Command
{
    protected $signature = 'app:fetch-news';

    protected $description = 'Fetches news from the NewsAPI provider and saves it to the database';

    public function handle(NewsApiProvider $newsApiProvider)
    {
        $this->info('Fetching news from NewsAPI...');
        $articles = $newsApiProvider->fetchData();

        if (empty($articles)) {
            $this->warn('No articles were fetched.');
            return;
        }

        $this->info('Saving ' . count($articles) . ' articles to the database...');

        //  ПРОГРЕСС-БАР 
        $bar = $this->output->createProgressBar(count($articles));
        $bar->start();

        
        foreach ($articles as $article) {
            
            NewsArticle::updateOrCreate(
                [
                    'url' => $article['url'], // Искать запись по уникальному полю URL
                ],
                [
                    'source' => $article['source']['name'] ?? 'N/A',
                    'title' => $article['title'] ?? 'N/A',
                    'description' => $article['description'] ?? '',
                    'published_at' => isset($article['publishedAt']) ? new \DateTime($article['publishedAt']) : null,
                ]
            );
            $bar->advance(); 
        }

        $bar->finish();
        $this->info("\nSuccessfully saved/updated articles.");
    }
}