<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\user\UserNotFoundException;
use miniPress\admin\services\user\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostRegisterAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $params = $rq->getParsedBody();

        $boxService = new UserService();

        if ($params['password'] == $params['confirm_password']) {
            if ($boxService->checkPassword($params['password'])) {
                if (!$boxService->existFromDatabase($params['email'])) {
                    $boxService->register($params);
                } else {
                    $view = Twig::fromRequest($rq);
                    return $view->render($rs, 'GetRegisterView.twig',[
                        'error' => 'L\'adresse email est déjà utilisée'
                    ]);
                }
            } else {
                $view = Twig::fromRequest($rq);
                return $view->render($rs, 'GetRegisterView.twig',[
                    'error' => 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial'
                ]);
            }
        } else {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'GetRegisterView.twig', [
                'error' => 'Les mots de passe ne sont pas identiques'
            ]);
        }

        $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('signin');

        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}