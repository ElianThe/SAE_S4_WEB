<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetArticlesAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $articles = ArticlesService::getArticles();

        $data = [
            'type' => 'collection',
            'count' => count($articles),
            'articles' => []
        ];

        foreach ($articles as $article) {
            $data['articles'][] = [
                'titre' => $article['title'],
                'date_creation' => $article['created_at'],
                'auteur' => $article['user']
            ];
        }

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}