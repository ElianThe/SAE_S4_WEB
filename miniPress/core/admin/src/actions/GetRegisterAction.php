<?php

namespace miniPress\admin\actions;

use miniPress\admin\actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetRegisterAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetRegisterView.twig');
    }
}