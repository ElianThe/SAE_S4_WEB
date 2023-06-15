<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesNotFoundException;
use miniPress\api\services\articles\ArticlesService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class GetArticlesByAuteur extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $idAuteur = $args["id"];

        try {
            $articles = ArticlesService::getArticleByAuteur($idAuteur);
        } catch (ArticlesNotFoundException $exception) {
            throw new HttpNotFoundException($rq, "Les articles du user pas trouvé ou le user est inconnu");
        }

        $data = [
            'article' => $articles
        ];

        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}