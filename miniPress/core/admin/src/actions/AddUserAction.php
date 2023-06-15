<?php

namespace miniPress\admin\action;

use miniPress\admin\actions\Action;
use miniPress\core\admin\src\services\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddUserAction extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

    }
}