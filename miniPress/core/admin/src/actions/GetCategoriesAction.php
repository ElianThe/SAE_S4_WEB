<?php

namespace miniPress\admin\actions;

use miniPress\admin\actions\Action;
use miniPress\admin\services\categorie\CategorieService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetCategoriesAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $categoriesService = new CategorieService();

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetCategoriesView.twig', [
            'categories' => $categoriesService->getCategories(),
        ]);
    }
}