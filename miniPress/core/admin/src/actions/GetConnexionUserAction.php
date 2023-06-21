<?php

namespace miniPress\admin\actions;

use miniPress\admin\actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetConnexionUserAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        //si est déjà connecté alors redirection vers la page d'articles
        if (isset($_SESSION['user_id'])) {
            $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('articlesList');
            return $rs->withStatus(302)->withHeader('Location', $url);
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetConnexionUserView.twig');
    }
}