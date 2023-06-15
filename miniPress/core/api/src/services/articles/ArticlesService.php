<?php

namespace miniPress\api\services\articles;

use miniPress\api\models\Article;

class ArticlesService
{
    public static function getArticles(): array
    {
        $articles = Article::with('user')->get();
        return $articles->toArray();
    }
}