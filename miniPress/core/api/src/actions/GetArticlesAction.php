<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetArticlesAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $articlesService = new ArticlesService();
        $articles = $articlesService->getArticles();

        $data = [
            'type' => 'collection',
            'count' => count($articles),
            'categories' => $articles
        ];

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}