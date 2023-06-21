<?php

namespace miniPress\api\actions;

use miniPress\api\services\categories\CategorieNotFoundException;
use miniPress\api\services\categories\CategoriesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

class GetCategorieArticlesActions extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

        $data = [];

        try {
            $articles =  CategoriesService::getCategorieById($args["id"])["articles"];
        } catch (CategorieNotFoundException) {
            throw new HttpNotFoundException($rq, 'Categorie pas trouvée');
        }

        foreach (
            $articles as $article
        ) {
            $data[] = [
                'article' => [
                    'id' => $article['id'],
                    'title' => $article['title'],
                    'summary' => $article['summary'],
                    'created_at' => $article['created_at'],
                    'isPublished' => $article['isPublished'],
                    'user' => $article['user'],
                ],
                'links' => [
                    'self' => [
                        'href' => RouteContext::fromRequest($rq)->getRouteParser()->urlFor('article', ['id' => $article['id']])
                    ]
                ]
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
