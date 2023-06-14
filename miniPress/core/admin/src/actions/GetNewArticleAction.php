<?php

namespace miniPress\admin\action;

use miniPress\admin\actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetNewArticleAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        // TODO: Implement __invoke() method.
    }
}