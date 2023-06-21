<?php

namespace miniPress\admin\actions;

use Exception;

use miniPress\admin\services\article\ArticleService;
use miniPress\admin\services\utils\CsrfException;
use miniPress\admin\services\utils\CsrfService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PostNewArticleAction extends Action
{

    /**
     * @throws Exception
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        //si est pas connecté alors erreur
        if (!isset($_SESSION['user_id'])) {
            throw new Exception('Vous devez être connecté pour accéder à cette page');
        }

        $data = $rq->getParsedBody();

        //Verification du token transmis par le formulaire
        $token = $data['csrf_token'] ?? null;

        try{
            CsrfService::check($token);
        }catch (CsrfException){
            throw new CsrfException("CSRF token is invalid");
        }

        //données du formulaire
        $articleData = [
            'title' => $data['title'] ?? throw new Exception('Missing title'),
            'summary' => $data['summary'] ?? throw new Exception('Missing summary'),
            'content' => $data['content'] ?? throw new Exception('Missing content'),
            'cat_id' => $data['category'] ?? throw new Exception('Missing category'),
        ];

        $articleService = new ArticleService();
        $articleService->createArticle($articleData);

        $url = RouteContext::fromRequest($rq)->getRouteParser()->urlFor('articlesList');

        return $rs->withStatus(302)->withHeader('Location', $url);
    }
}