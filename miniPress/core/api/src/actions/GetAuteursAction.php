<?php

namespace miniPress\api\actions;

use miniPress\api\services\articles\ArticlesNotFoundException;
use miniPress\api\services\articles\ArticlesService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;
use Slim\Exception\HttpNotFoundException;

class GetAuteursAction extends Action
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

        try {

            $auteurs = ArticlesService::getAuteurs();

            $data = [
                'type' => 'collection',
                'count' => count($auteurs),
                'auteurs' => []
            ];
            foreach ($auteurs as $auteur) {
                $data['auteurs'][] = [
                    'auteur' => $auteur,
                    'links' => [
                        'articles' => [
                            'href' => RouteContext::fromRequest($rq)->getRouteParser()->urlFor('auteurArticles', ['id' => $auteur['id']])
                        ],
                    ]
                ];
            }
        } catch (ArticlesNotFoundException) {
            throw new  HttpNotFoundException($rq, 'auteurs pas trouvés');
        }

        $rs->getBody()->write(json_encode($data));

        return $rs->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}