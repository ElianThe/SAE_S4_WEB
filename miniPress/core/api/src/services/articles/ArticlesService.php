<?php

namespace miniPress\api\services\articles;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use miniPress\api\models\Article;

class ArticlesService
{
    public static function getArticles(): array
    {
        $articles = Article::with('user')->get();
        return $articles->toArray();
    }

    public static function getArticleById($id) : array
    {
        try {
            $articles = Article::where('id', $id)->get();
        } catch (ModelNotFoundException $exception) {
            throw new ArticlesNotFoundException("l'article n'a pas été trouvé avec cette id");
        }
        return $articles->toArray();
    }

    public static function getArticleByAuteur($userId): array {
        try {
            $article = Article::where('user_id', $userId)->get();
        } catch (ModelNotFoundException $exception) {
            throw new ArticlesNotFoundException("l'id du user n'est pas trouvé");
        }
        return $article->toArray();
    }
}