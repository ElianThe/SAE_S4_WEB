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

        if($userService->existFromDatabase($params['email'])) {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'GetAddEditorView.twig',[
                'error' => 'L\'utilisateur existe déjà'
            ]);
        }else {
            $userService->createEditorUser($params['email'], $params['password']);
        }

        $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('articlesList');

        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}