<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\user\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;

class GetLogoutAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $userService = new UserService();
        $userService->logout();

        $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('signin');

        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}