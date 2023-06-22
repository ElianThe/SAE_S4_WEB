<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\user\UserNotFoundException;
use miniPress\admin\services\user\UserService;
use miniPress\admin\services\utils\CsrfException;
use miniPress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class PostAddEditorAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $params = $rq->getParsedBody();

        //Verification du token transmis par le formulaire
        $token = $params['csrf_token'] ?? null;

        try{
            CsrfService::check($token);
        }catch (CsrfException){
            throw new CsrfException("CSRF token is invalid");
        }

        $userService = new UserService();

        if(!$userService->isAdmin()) {
            throw new HttpUnauthorizedException($rq, "Vous n'êtes pas autorisé à accéder à la page de création de compte éditeur");
        }

        if($userService->existFromDatabase($params['email'])) {
            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'GetAddEditorView.twig',[
                'error' => 'L\'utilisateur existe déjà'
            ]);
        }else {
            $userService->createEditorUser($params['email'], $params['password'], $params['name']);
        }

        $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('articlesList');

        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}