<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\classes\Validator;
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
        $this -> longUrl = $body['url'];

        if(!AuthMiddleware::auth($token,$username)) {
            $response -> getBody() -> write(json_encode(['errors' => ['Unauthorized']]));
            return $response
                -> withHeader('Content-Type', 'application/json')
                -> withStatus(403);
        }

        if(!Validator::url($this -> longUrl)) {
            $response -> getBody() -> write(json_encode(['errors' => ['Value is not an URL']]));
            return $response
                -> withHeader('Content-Type', 'application/json')
                -> withStatus(401);
        }

        $this -> shortUrl = $this -> createURL();
    }

    private function createURL():string {
        return substr(
            base64_encode(
                sha1(uniqid(
                    random_bytes(self::RANDOM_BYTES),
                    true
                ))
            ),
            0,
            self::URL_LENGHT
        );
    }
}