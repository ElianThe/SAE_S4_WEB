<?php

namespace miniPress\admin\actions;

use miniPress\admin\services\article\ArticleNotFoundException;
use miniPress\admin\services\article\ArticleService;
use miniPress\admin\services\user\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Routing\RouteContext;

class GetPublicationAction extends Action
{

    /**
     * @throws ArticleNotFoundException
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        //si est pas connecté alors erreur
        if (!isset($_SESSION['user_id'])) {
            throw new HttpBadRequestException($rq, "Vous n'êtes pas connecté");
        }

        $userService = new UserService();
        $articleService = new ArticleService();
        $id = $args['article_id'];

        if($articleService->isArticleOwner($args['article_id'], $_SESSION['user_id'])) {
            $articleService->publishArticle($id);
        } elseif ($userService->isAdmin()){
            $articleService->publishArticle($id);
        } else {
            throw new HttpUnauthorizedException($rq, "Vous n'êtes pas autorisé à publier/dépublier cet article");

        }

        return $rs->withStatus(302)->withHeader('Location', RouteContext::fromRequest($rq)->getRouteParser()->urlFor('articlesList'));
    }
}