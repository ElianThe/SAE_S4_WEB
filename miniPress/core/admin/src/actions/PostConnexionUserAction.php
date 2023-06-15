<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\user\UserNotFoundException;
use miniPress\admin\services\user\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostConnexionUserAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $params = $rq->getParsedBody();

        $boxService = new UserService();

        if(!$boxService->existFromDatabase($params['email'])) {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'GetConnexionUserView.twig',[
                'error' => 'L\'utilisateur n\'existe pas'
            ]);
        }else {
            if ($boxService->isSamePassword($params['email'], $params['password'])) {
                $boxService->signIn($params['email'], $params['password']);
            } else {
                $view = Twig::fromRequest($rq);
                return $view->render($rs, 'GetConnexionUserView.twig', [
                    'error' => 'Le mot de passe est incorrect'
                ]);
            }
        }

        $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('articlesList');

        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}