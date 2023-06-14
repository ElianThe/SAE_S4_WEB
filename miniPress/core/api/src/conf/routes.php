<?php

use miniPress\api\actions\GetArticlesAction;
use miniPress\api\actions\GetCategoriesAction;

require_once __DIR__ . '/../vendor/autoload.php';

return function (\Slim\App $app): void {

    $app->get('/api/categories', GetCategoriesAction::class);

    $app->get('/api/articles', GetArticlesAction::class);

};