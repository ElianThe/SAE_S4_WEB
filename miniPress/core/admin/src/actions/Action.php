<?php

namespace miniPress\admin\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

abstract class Action
{
    public string $view = "homeView";

    abstract public function __invoke(Request $rq, Response $rs, array $args): Response;
}