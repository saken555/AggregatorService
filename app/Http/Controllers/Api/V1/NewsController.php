<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle; 
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $articles = NewsArticle::orderBy('published_at', 'desc')
                               ->limit(25)
                               ->get();

        
        return response()->json([
            'status' => 'success',
            'data' => $articles,
        ]);
    }
}