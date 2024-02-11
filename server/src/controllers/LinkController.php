<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\middleware\AuthMiddleware;

class LinkController
{
    private const URL_LENGHT = 5;
    private const RANDOM_BYTES = 32;
    private string $longUrl;
    private string $shortUrl;
    public function shorten(Request $request, Response $response) {
        $body = $request -> getBody();

        $username = $body['username'];
        $token = $body['token'];

        if(!AuthMiddleware::auth($token,$username)) {
            $response -> getBody() -> write(json_encode(['errors' => ['Unauthorized']]));
            return $response
                -> withHeader('Content-Type', 'application/json')
                -> withStatus(403);
        }
    }
}