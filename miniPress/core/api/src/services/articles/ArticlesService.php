<?php

namespace miniPress\api\services\articles;

use miniPress\api\models\Article;

class ArticlesService
{
    public function getArticles(): array
    {
        $articles = Article::all();
        return $articles->toArray();
    }
}