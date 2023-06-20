<?php

namespace miniPress\api\services\articles;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use miniPress\api\models\Article;

class ArticlesService
{
    public static function getArticles(): array
    {
        try {
            $articles = Article::with('user')->get();
        } catch (ModelNotFoundException) {
            throw new ArticlesNotFoundException("l'article n'a pas été trouvé avec cette id");
        }
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

    public static function getArticleSortDate ($sort) : array {
        try {
            if ($sort == "date-asc") {
                $articles = Article::all()->sortBy('published_at');
            } else {
                $articles = Article::all()->sortByDesc('published_at');
            }
        } catch (ModelNotFoundException) {
            throw new ArticlesNotFoundException('"le sort est surement mauvais');
        }
        return $articles->toArray();
    }

    public static function getArticleSortAuteur () : array{
        try {
            $articles = Article::all()->sortBy('user_id');
        } catch (ModelNotFoundException) {
            throw new ArticlesNotFoundException('"le sort est surement mauvais');
        }
        return $articles->toArray();
    }
}