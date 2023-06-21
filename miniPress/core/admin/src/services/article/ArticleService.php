<?php

namespace miniPress\admin\services\article;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use miniPress\admin\models\Article;
use miniPress\admin\models\User;

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
            $article->user_id = $_SESSION['user_id'];
            $article->isPublished = 0;
        } else {
            throw new Exception('Missing title, summary or content in box creation');
        }

        //sauvegarde de l'article
        $article->save();
    }

    //trier par date de création descendante
    public function getArticles(): array
    {
        $articles = Article::with('user')->orderBy('created_at', 'desc')->get();
        return $articles->toArray();
    }


    /**
     * @throws CategorieNotFoundException
     */
    ////trier par date de création descendante
    public function getArticlesByCategorie(int $cat_id): array
    {
        try {
            $articles = Article::with('user')->where('cat_id', $cat_id)->orderBy('created_at', 'desc')->get();
            return $articles->toArray();
        } catch (ModelNotFoundException) {
            throw new CategorieNotFoundException();
        }
    }

    //publier un article ou le dépublier si il est déjà publié

    /**
     * @throws ArticleNotFoundException
     */
    public function publishArticle(int $id): void
    {
        try {
            $article = Article::findOrFail($id);
            if ($article->isPublished == 0) {
                $article->isPublished = 1;
                $article->published_at = date('Y-m-d H:i:s');
            } else {
                $article->isPublished = 0;
                $article->published_at = null;
            }
            $article->save();
        } catch (ModelNotFoundException) {
            throw new ArticleNotFoundException();
        }
    }

    //verifie si l'article appartient à l'user
    public function isArticleOwner(mixed $article_id, mixed $id_user): bool
    {
        $user = User::where('id' ,$id_user)->firstOrFail();
        $article = Article::findOrFail($article_id);
        if ($article->user_id === $user->id) {
            return true;
        } else {
            return false;
        }
    }

}