<?php

namespace miniPress\api\actions;

use miniPress\api\services\categories\CategoriesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetCategorieArticlesActions extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = [];
        foreach (
            CategoriesService::getCategorieById($args["id"])["articles"] as $article
        ) {
            $data[] = [
                'titre' => $article["title"],
                'date_creation' => $article["created_at"],
                'auteur' => $article["user_id"],
                'url' => "/api/articles/{$article["id"]}"
            ];
        }

        $rs->getBody()->write(json_encode([
            'type' => 'collection',
            'count' => count($data),
            'articles' => $data
        ]));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}