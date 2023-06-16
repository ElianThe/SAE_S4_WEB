<?php

use miniPress\api\actions\GetArticleById;
use miniPress\api\actions\GetArticlesAction;
use miniPress\api\actions\GetArticlesByAuteur;
use miniPress\api\actions\GetCategorieArticlesActions;
use miniPress\api\actions\GetCategoriesAction;
use Slim\Routing\RouteCollectorProxy;

require_once __DIR__ . '/../vendor/autoload.php';

return function (\Slim\App $app): void {
    $app->group('/api', function (RouteCollectorProxy $api) {
        $api->group('/categories', function (RouteCollectorProxy $categorie) {
            $categorie->get('[/]', GetCategoriesAction::class);
            $categorie->get('/{id}/articles[/]', GetCategorieArticlesActions::class);
        });

        $api->group('/articles', function (RouteCollectorProxy $articles) {
            $articles->get('[/]', GetArticlesAction::class);
            $articles->get('/{id}', GetArticleById::class);
        });

        $api->get('/auteurs/{id}/articles[/]', GetArticlesByAuteur::class);
    });
};