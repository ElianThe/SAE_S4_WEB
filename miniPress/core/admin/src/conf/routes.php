<?php

use miniPress\admin\actions\GetArticlesAction;
use miniPress\admin\actions\GetCategoriesAction;
use miniPress\admin\actions\GetAddUserAction;
use miniPress\admin\actions\GetConnexionUserAction;
use miniPress\admin\actions\PostAddUserAction;
use miniPress\admin\actions\GetNewArticleAction;
use miniPress\admin\actions\GetNewCategorieAction;
use miniPress\admin\actions\PostConnexionUserAction;
use miniPress\admin\actions\PostNewArticleAction;
use miniPress\admin\actions\PostNewCategorieAction;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

return function (App $app): void {

    $app->get('/article/new[/]', GetNewArticleAction::class)->setName('createArticle');
    $app->post('/article/new[/]', PostNewArticleAction::class)->setName('createdArticle');

    $app->get('/article[/]', GetArticlesAction::class)->setName('articlesList');

    $app->get('/categorie/new[/]', GetNewCategorieAction::class)->setName('createCategorie');
    $app->post('/categorie/new[/]', PostNewCategorieAction::class)->setName('createdCategorie');

    $app->get('/categorie[/]', GetCategoriesAction::class)->setName('categoriesList');

    //1) Créer un article : affichage et traitement d’un formulaire de saisie d’un article comprenant le
    //titre, le résumé et le contenu de l’article. La date de création est automatiquement valorisée. Le
    //résumé et le contenu sont saisis et stockés en base de données au format markdown

    //route get
    $app->get('/register[/]', GetAddUserAction::class)->setName('register');
    $app->get('/signin[/]', GetConnexionUserAction::class)->setName('signin');

    //route post
    $app->post('/register[/]', PostAddUserAction::class)->setName('registerPost');
    $app->post('/signin[/]', PostConnexionUserAction::class)->setName('signinPost');

};

