<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesNotFoundException;
use miniPress\api\services\articles\AuteursService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class TriParDateArticle extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $sort = $args['sort'];
        try {
            if ($sort == "auteur") {
                $articles = AuteursService::getArticleSortAuteur();
                $data = [
                    'articles' => $articles
                ];
            } else if ($sort == "date-asc" || $sort == "date-desc") {
                $articles = AuteursService::getArticleSortDate($sort);
                $data = [
                    'articles' => $articles
                ];
            }
        } catch (ArticlesNotFoundException) {
            throw new  HttpNotFoundException($rq, 'articles pas trouvés');
        }

        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}