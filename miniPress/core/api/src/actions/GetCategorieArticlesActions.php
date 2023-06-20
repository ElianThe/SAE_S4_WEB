<?php

namespace miniPress\api\actions;

use miniPress\api\services\categories\CategoriesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class GetCategorieArticlesActions extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($rq);

        $data = [];

        foreach (
            CategoriesService::getCategorieById($args["id"])["articles"] as $article
        ) {
            $data[] = [
                'article' => [
                    'id' => $article['id'],
                    'title' => $article['title'],
                    'created_at' => $article['created_at'],
                    'user_id' => $article['user_id'], //TODO : a changer pour se baser sur l'objet user
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
