<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesNotFoundException;
use miniPress\api\services\articles\ArticlesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use Slim\Exception\HttpNotFoundException;

class GetArticlesAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

        if (isset($rq->getQueryParams()['sort'])) {
            $sort = $rq->getQueryParams()['sort'];
        } else {
            $sort = "";
        }

        try {
            if ($sort == "auteur") {
                $articles = ArticlesService::getArticleSortAuteur();
            } else if ($sort == "date-asc" || $sort == "date-desc") {
                $articles = ArticlesService::getArticleSortDate($sort);
            } else {
                $articles = ArticlesService::getArticles();
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
                        'created_at' => $article['created_at'],
                        'user_id' => $article['user_id'],
                    ],
                    'links' => [
                        'self' => [
                            'href' => RouteContext::fromRequest($rq)->getRouteParser()->urlFor('article', ['id' => $article['id']])
                        ]
                    ]
                ];
            }
        } catch (ArticlesNotFoundException $exception) {
            throw new  HttpNotFoundException($rq, 'articles pas trouvés');
        }

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
