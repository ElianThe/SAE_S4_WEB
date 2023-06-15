<?php

namespace miniPress\admin\services\article;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use miniPress\admin\models\Article;

class ArticleService
{
    /**
     * @throws Exception
     */
    public function createArticle(array $data): void
    {
        //filtre les données
        $titleFiltered = htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8');
        $summaryFiltered = htmlspecialchars($data['summary'], ENT_QUOTES, 'UTF-8');
        $contentFiltered = htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8');

        //création de l'article
        if (isset($data['title']) && isset($data['content']) && isset($data['summary'])) {
            $article = new Article();
            $article->title = $data['title'];
            $article->summary = $data['summary'];
            $article->content = $data['content'];
            $article->cat_id = $data['cat_id'];
            $article->user_id = 1;
            $article->isPublished = 0;
        } else {
            throw new Exception('Missing title, summary or content in box creation');
        }

        //sauvegarde de l'article
        $article->save();
    }


    public function getArticles(): array
    {
        $articles = Article::all();
        return $articles->toArray();
    }

}