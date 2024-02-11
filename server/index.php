<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $result = "Hello World";
    $response->getBody()->write(json_encode($result));
    return $response -> withHeader('Content-Type', 'application/json');
});

$app -> get('/l/{url}', '\App\controllers\RedirectController:getUrl');

$app -> post('/shorten', '\App\controllers\LinkController:shorten');
$app -> post('/register', '\App\controllers\RegisterController:register');
$app -> post('/login', '\App\controllers\LoginController:login');
$app -> post('/getUrls','\App\controllers\UrlController:getLinks');

$app->run();
