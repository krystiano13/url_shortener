<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\classes\Database;
use App\controllers\LinkController;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {

    $db = new Database();
    $result = $db -> query(
        "SELECT * FROM users"
    );
    $response->getBody()->write(json_encode(['test' => 'hello world']));
    return $response -> withHeader('Content-Type', 'application/json');
});

$app -> post('/shorten', '\App\controllers\LinkController:shorten');

$app->run();
