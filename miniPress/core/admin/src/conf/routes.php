<?php

use miniPress\admin\actions\GetNewArticleAction;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

return function (App $app): void {

    $app->get('/article/new[/]', GetNewArticleAction::class)->setName('createArticle');

};

