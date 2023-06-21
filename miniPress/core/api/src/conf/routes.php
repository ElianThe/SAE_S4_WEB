<?php

use miniPress\api\actions\GetAuteursAction;
use miniPress\api\actions\GetArticleById;
use miniPress\api\actions\GetArticlesAction;
use miniPress\api\actions\GetAuteurArticlesAction;
use miniPress\api\actions\GetCategorieArticlesActions;
use miniPress\api\actions\GetCategoriesAction;
use Slim\Routing\RouteCollectorProxy;

require_once __DIR__ . '/../vendor/autoload.php';

return function (\Slim\App $app): void {
    $app->group('/api', function (RouteCollectorProxy $api) {
        $api->group('/categories', function (RouteCollectorProxy $categorie) {
            $categorie->get('[/]', GetCategoriesAction::class)->setName('categories');
            $categorie->get('/{id}/articles[/]', GetCategorieArticlesActions::class)->setName('categorieArticles');
        });

        $api->group('/articles', function (RouteCollectorProxy $articles) {
            $articles->get('[/]', GetArticlesAction::class)->setName('articles');
            $articles->get('/{id:[0-9]+}', GetArticleById::class)->setName('article');
        });

        $api->group('/auteurs', function (RouteCollectorProxy $auteurs) {
            $auteurs->get('[/]', GetAuteursAction::class)->setName('auteurs');
            $auteurs->get('/{id}/articles[/]', GetAuteurArticlesAction::class)->setName('auteurArticles');
        });
    });
};