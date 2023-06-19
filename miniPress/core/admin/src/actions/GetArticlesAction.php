<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\article\ArticleService;
use miniPress\admin\services\article\CategorieNotFoundException;
use miniPress\admin\services\categorie\CategorieService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetArticlesAction extends Action
{
    /**
     * @throws SyntaxError
     * @throws CategorieNotFoundException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $articlesService = new ArticleService();
        $categorieService = new CategorieService();

        $idCatTrier = $rq->getQueryParams()['tri'] ?? "";
        if ($idCatTrier == "") {
            $articles = $articlesService->getArticles();
        } else {
            $articles = $articlesService->getArticlesByCategorie($idCatTrier);
        }

        $routeParser = RouteContext::fromRequest($rq)->getRouteParser();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'GetArticlesView.twig', [
            'articles' => $articles,
            'categories' => $categorieService->getCategories(),
        ]);
    }
}