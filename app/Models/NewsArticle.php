<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;


    protected $fillable = [
        'source',
        'title',
        'description',
        'url',
        'published_at',
    ];


    protected $casts = [
        'published_at' => 'datetime',
    ];
}
