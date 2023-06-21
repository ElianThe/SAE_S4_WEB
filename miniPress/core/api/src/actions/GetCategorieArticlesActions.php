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
            $larticle =  CategoriesService::getCategorieById($args["id"])["articles"];
        } catch (CategorieNotFoundException) {
            throw new HttpNotFoundException($rq, 'Categorie pas trouvée');
        }

        foreach (
            $larticle as $article
        ) {
            $data[] = [
                'article' => [
                    'id' => $article['id'],
                    'title' => $article['title'],
                    'summary' => $article['summary'],
                    'content' => $article['content'],
                    'created_at' => $article['created_at'],
                    'isPublished' => $article['isPublished'] == 1 ? true : false,
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
