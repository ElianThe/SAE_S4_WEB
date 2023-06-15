<?php

namespace miniPress\api\actions;

use miniPress\api\services\categories\CategoriesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetCategoriesAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $categories = CategoriesService::getCategories();

        $data = [
            'type' => 'collection',
            'count' => count($categories),
            'categories' => $categories
        ];

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}