<?php

namespace miniPress\api\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCategoriesApi
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args) {
        $data = ['type' => 'ressource',
            'count' => 2,
            'categorie' => 'bla'];
        $response->getBody()->write(json_encode('coucou'));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}