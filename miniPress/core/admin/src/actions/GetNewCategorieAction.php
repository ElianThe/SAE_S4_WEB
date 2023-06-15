<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetNewCategorieAction extends Action
{

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetNewCategorieView.twig' ,
            ['token' => CsrfService::generate()]
        );
    }
}