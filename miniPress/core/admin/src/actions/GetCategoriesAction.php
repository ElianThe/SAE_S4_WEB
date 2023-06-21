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
        //si est pas connecté alors redirection vers la page de connexion
        if (!isset($_SESSION['user_id'])) {
            $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('signin');
            return $rs->withStatus(302)->withHeader('Location', $url);
        }

        $categoriesService = new CategorieService();

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetCategoriesView.twig', [
            'categories' => $categoriesService->getCategories(),
        ]);
    }
}