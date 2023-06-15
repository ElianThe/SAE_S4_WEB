<?php

namespace miniPress\admin\actions;

use Exception;

use miniPress\admin\services\article\ArticleService;
use miniPress\admin\services\categorie\CategorieService;
use miniPress\admin\services\utils\CsrfException;
use miniPress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PostNewCategorieAction extends Action
{

    /**
     * @throws Exception
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $data = $rq->getParsedBody();

        //Verification du token transmis par le formulaire
        $token = $data['csrf_token'] ?? null;

        try{
            CsrfService::check($token);
        }catch (CsrfException){
            throw new CsrfException("CSRF token is invalid");
        }

        //données du formulaire
        $categorieData = [
            'name' => $data['name'] ?? throw new Exception('Missing name'),
        ];

        $categorieService = new CategorieService();
        $categorieService->createCategorie($categorieData);

        $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('categoriesList');

        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}