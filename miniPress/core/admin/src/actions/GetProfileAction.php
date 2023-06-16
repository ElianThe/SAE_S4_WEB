<?php

namespace miniPress\admin\actions;

use miniPress\admin\actions\Action;
use miniPress\admin\models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetProfileAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $user = $_SESSION['user'];
        $user = unserialize(serialize($user));

        $user->role = 'admin';
        $user->save();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetProfileView.twig', [
            'user' => $user,
        ]);
    }
}