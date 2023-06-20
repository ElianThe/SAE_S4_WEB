<?php

namespace miniPress\admin\actions;

use miniPress\admin\actions\Action;
use miniPress\admin\models\User;
use miniPress\admin\services\user\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;

class GetProfileAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
            //si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion

            if (!isset($_SESSION['user_id'])) {
                $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('signin');
                return $rs->withStatus(302)->withHeader('Location', $url);
            }

            $userId = $_SESSION['user_id'];
            $user = User::findOrFail($userId);

            $view = Twig::fromRequest($rq);
            return $view->render($rs, 'GetProfileView.twig', [
                'user' => $user,
            ]);

    }
}