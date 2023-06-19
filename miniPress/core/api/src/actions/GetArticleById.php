<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesNotFoundException;
use miniPress\api\services\articles\ArticlesService;
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
            $article = ArticlesService::getArticleById($id);
        } catch (ArticlesNotFoundException $exception) {
            throw new HttpNotFoundException($rq, 'Article avec id non trouvé');
        }

        $routeContext = RouteContext::fromRequest($rq);

        $data = [
            'type' => 'resource',
            'article' => $article
        ];

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}