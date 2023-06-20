<?php

namespace miniPress\api\actions;

use Slim\Routing\RouteContext;
use miniPress\api\services\categories\CategoriesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetCategoriesAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $categories = CategoriesService::getCategories();

        $routeContext = RouteContext::fromRequest($rq);

        $data = [
            'type' => 'collection',
            'count' => count($categories),
            'categories' => []
        ];

        foreach ($categories as $category) {
            $data['categories'][] = [
                'category' => $category,
                'links' => [
                    'articles' => [
                        'href' => $routeContext->getRouteParser()->urlFor('categorieArticles', ['id' => $category['id']])
                    ]
                ]
            ];
        }

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}