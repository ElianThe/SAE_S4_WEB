<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesNotFoundException;
use miniPress\api\services\articles\ArticlesService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

class GetArticlesByAuteur extends Action
{

    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $idAuteur = $args["id"];

        try {
            $articles = ArticlesService::getArticleByAuteur($idAuteur);
        } catch (ArticlesNotFoundException) {
            throw new HttpNotFoundException($rq, "Les articles du user pas trouvé ou le user est inconnu");
        }

        $data = [
            'type' => 'collection',
            'count' => count($articles),
            'articles' => []
        ];
        foreach ($articles as $article) {
            $data['articles'][] = [
                'article' => [
                    'id' => $article['id'],
                    'title' => $article['title'],
                    'summary' => $article['summary'],
                    'content' => $article['content'],
                    'created_at' => $article['created_at'],
                    'isPublished' => $article['isPublished'] == 1 ? true : false,
                    'user_id' => $article['user']['id'],
                ],
                'links' => [
                    'self' => [
                        'href' => RouteContext::fromRequest($rq)->getRouteParser()->urlFor('article', ['id' => $article['id']])
                    ]
                ]
            ];
        }

        $rs->getBody()->write(json_encode($data));
        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}