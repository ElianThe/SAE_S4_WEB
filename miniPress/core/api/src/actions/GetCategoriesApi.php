<?php

namespace miniPress\api\actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetCategoriesApi extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = ['type' => 'ressource',
            'count' => 2,
            'categorie' => 'bla'];
        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}