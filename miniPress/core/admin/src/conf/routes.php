<?php

require_once __DIR__ . '/../vendor/autoload.php';

return function (\Slim\App $app): void {

    //1) Créer un article : affichage et traitement d’un formulaire de saisie d’un article comprenant le
    //titre, le résumé et le contenu de l’article. La date de création est automatiquement valorisée. Le
    //résumé et le contenu sont saisis et stockés en base de données au format markdown

    //route get
    $app->get('/article/new[/]', GetNewArticleAction::class)->setName('admin');

};