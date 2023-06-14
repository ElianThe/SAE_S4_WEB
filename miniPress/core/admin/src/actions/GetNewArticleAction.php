<?php

namespace miniPress\admin\actions;

use miniPress\admin\actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetNewArticleAction extends Action
{

    //1) Créer un article : affichage et traitement d’un formulaire de saisie d’un article comprenant le
    //titre, le résumé et le contenu de l’article. La date de création est automatiquement valorisée. Le
    //résumé et le contenu sont saisis et stockés en base de données au format markdown.

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetNewArticleView.twig', [
        ]);
    }
}