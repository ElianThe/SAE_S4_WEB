<?php
use miniPress\admin\services\utils\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

// Ajout du twig
$twig = Twig::create( __DIR__ . '/../views',
                                    ['cache' => __DIR__ . '/../views/cache',
                                    'auto_reload' => true]);

$twig->getEnvironment()->addGlobal('session', $_SESSION);

$app->add(TwigMiddleware::create($app, $twig)) ;

//gestionnaire d'erreur
$app->addErrorMiddleware(true, false, false);

// Initialisation de Eloquent
Eloquent::init(__DIR__ . DIRECTORY_SEPARATOR .'miniPress.db.conf.ini');

// Retourner l'application configurée
return $app;