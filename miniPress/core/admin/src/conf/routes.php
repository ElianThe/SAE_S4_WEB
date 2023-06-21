<?php

use miniPress\admin\actions\GetAddEditorAction;
use miniPress\admin\actions\GetArticlesAction;
use miniPress\admin\actions\GetCategoriesAction;
use miniPress\admin\actions\GetProfileAction;
use miniPress\admin\actions\GetPublicationAction;
use miniPress\admin\actions\GetRegisterAction;
use miniPress\admin\actions\GetConnexionUserAction;
use miniPress\admin\actions\GetLogoutAction;
use miniPress\admin\actions\PostAddEditorAction;
use miniPress\admin\actions\PostRegisterAction;
use miniPress\admin\actions\GetNewArticleAction;
use miniPress\admin\actions\GetNewCategorieAction;
use miniPress\admin\actions\PostConnexionUserAction;
use miniPress\admin\actions\PostNewArticleAction;
use miniPress\admin\actions\PostNewCategorieAction;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

return function (App $app): void {

    //route de base
    $app->get('/', GetConnexionUserAction::class)->setName('home');

    $app->get('/article/new[/]', GetNewArticleAction::class)->setName('createArticle');
    $app->post('/article/new[/]', PostNewArticleAction::class)->setName('createdArticle');

    $app->get('/article[/]', GetArticlesAction::class)->setName('articlesList');

    $app->get('/categorie/new[/]', GetNewCategorieAction::class)->setName('createCategorie');
    $app->post('/categorie/new[/]', PostNewCategorieAction::class)->setName('createdCategorie');

    $app->get('/categorie[/]', GetCategoriesAction::class)->setName('categoriesList');

    $app->get('/publication/{article_id}[/]', GetPublicationAction::class)->setName('publication');

    //route get
    $app->get('/signin[/]', GetConnexionUserAction::class)->setName('signin');
    $app->get('/logout[/]', GetLogoutAction::class)->setName('logout');
    $app->get('/profile[/]', GetProfileAction::class)->setName('profile');
    $app->get('/addEditor[/]', GetAddEditorAction::class)->setName('addEditor');

    //route post
    $app->post('/signin[/]', PostConnexionUserAction::class)->setName('signinPost');
    $app->post('/addEditor[/]', PostAddEditorAction::class)->setName('addEditorPost');

};

