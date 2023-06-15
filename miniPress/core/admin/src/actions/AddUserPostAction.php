<?php

namespace miniPress\admin\action;

use miniPress\admin\actions\Action;
use miniPress\core\admin\src\services\UserNotFoundException;
use miniPress\core\admin\src\services\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class AddUserPostAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $params = $rq->getParsedBody();

        $boxService = new UserService();

        if ($boxService->checkPassword($params['password'])){
            if (!$boxService->existFromDatabase($params['email'])){
                $boxService->register($params);
            } else {
                throw new UserNotFoundException('Utilisateur déjà existant', 404);
            }
        } else {
            throw new UserNotFoundException('Mot de passe invalide', 404);
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'connexion.twig');
    }
}