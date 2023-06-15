<?php

use miniPress\api\actions\GetArticlesAction;
use miniPress\api\actions\GetCategorieArticlesActions;
use miniPress\api\actions\GetCategoriesAction;
use Slim\Routing\RouteCollectorProxy;

require_once __DIR__ . '/../vendor/autoload.php';

return function (\Slim\App $app): void {
    $app->group('/api', function (RouteCollectorProxy $api) {
        $api->group('/categories', function (RouteCollectorProxy $categorie) {
            $categorie->get('', GetCategoriesAction::class);
            $categorie->get('/{id}/articles', GetCategorieArticlesActions::class);
        });

        $api->get('/articles', GetArticlesAction::class);
    });
};