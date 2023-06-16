<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\user\UserNotFoundException;
use miniPress\admin\services\user\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostAddEditorAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $params = $rq->getParsedBody();

        $userService = new UserService();

        $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('articlesList');

        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}