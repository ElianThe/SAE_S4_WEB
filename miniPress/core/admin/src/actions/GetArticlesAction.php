<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\article\ArticleService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetArticlesAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $articlesService = new ArticleService();

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetArticlesView.twig', [
            'articles' => $articlesService->getArticles(),
        ]);
    }
}