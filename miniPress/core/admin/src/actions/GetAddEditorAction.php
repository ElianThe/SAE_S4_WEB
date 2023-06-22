<?php

namespace miniPress\admin\actions;

use miniPress\admin\actions\Action;
use miniPress\admin\services\user\UserService;
use miniPress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Views\Twig;

class GetAddEditorAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        //vérifie si l'utilisateur est pas admin
        $userService = new UserService();

        if(!$userService->isAdmin()) {
            throw new HttpUnauthorizedException($rq, "Vous n'êtes pas autorisé à accéder à la page de création de compte éditeur");
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetAddEditorView.twig', [
            'token' => CsrfService::generate()
        ]);
    }
}