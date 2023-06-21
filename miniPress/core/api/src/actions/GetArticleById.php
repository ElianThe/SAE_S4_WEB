<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesNotFoundException;
use miniPress\api\services\articles\AuteursService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

class GetArticleById extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $id = $args['id'];

        try {
            $article = AuteursService::getArticleById($id);
        } catch (ArticlesNotFoundException) {
            throw new HttpNotFoundException($rq, 'Article avec id non trouvé');
        }

        $data = [
            'type' => 'resource',
            'count' => count($article),
            'article' => [
                'id' => $article['id'],
                'title' => $article['title'],
                'summary' => $article['summary'],
                'content' => $article['content'],
                'created_at' => $article['created_at'],
                'user' => $article['user'],
                'links' => [
                    'self' => [
                        'href' => RouteContext::fromRequest($rq)->getRouteParser()->urlFor('article', ['id' => $article['id']])
                    ]
                ]
            ]
        ];

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}