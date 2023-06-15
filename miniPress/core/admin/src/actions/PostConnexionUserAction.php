<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\user\UserNotFoundException;
use miniPress\admin\services\user\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostConnexionUserAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $params = $rq->getParsedBody();

        $boxService = new UserService();

        try {
            $boxService->signIn($params['email'], $params['password']);
        } catch (UserNotFoundException $exception) {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'GetConnexionUserView.twig',[
                'error' => 'Identifiant ou mot de passe incorrect'
            ]);
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetConnexionUserView.twig',[
            'success' => 'L\'utilisateur a bien été connecté'
        ]);
    }
}