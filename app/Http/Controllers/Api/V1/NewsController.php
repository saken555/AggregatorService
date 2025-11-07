<?php

namespace App\Http\Controllers\Api\V1; 

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; 

class NewsController extends Controller
{

    public function index()
    {
    
        $articles = Cache::remember('news.latest_25', 600, function () {
            
            return NewsArticle::orderBy('published_at', 'desc')
                                ->limit(25)
                                ->get();
        });

        return response()->json([
            'status' => 'success',
            'data' => $articles,
        ]);
    }
}