<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class GetArticlesAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $routeContext = RouteContext::fromRequest($rq);

        $articles = ArticlesService::getArticles();

        $data = [
            'type' => 'collection',
            'count' => count($articles),
            'articles' => []
        ];

        foreach ($articles as $article) {
            $data['articles'][] = [
                'article' => [
                    'titre' => $article['title'],
                    'date_creation' => $article['created_at'],
                    'user_id' => $article['user']['id'],
                ],
                'links' => [
                    'self' => [
                        'href' => $routeContext->getRouteParser()->urlFor('article', ['id' => $article['id']])
                    ]
                ]
            ];
        }

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}