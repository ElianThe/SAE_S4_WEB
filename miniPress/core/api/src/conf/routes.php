<?php

use miniPress\api\actions\GetCategoriesApi;

return function (\Slim\App $app) {
    $app->get('/api/categories', GetCategoriesApi::class);
};