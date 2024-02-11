<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\classes\Validator;
use App\middleware\AuthMiddleware;
use App\classes\Database;

class LinkController
{
    private const URL_LENGHT = 5;
    private const RANDOM_BYTES = 32;
    private string $longUrl;
    private string $shortUrl;
    public function shorten(Request $request, Response $response) {
        $body = $request -> getParsedBody();

        $username = $body['username'] ?? null;
        $token = $body['token'] ?? null;
        $this -> longUrl = $body['url'];

        if($username !== null && $token !== null && !AuthMiddleware::auth($token,$username)) {
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
        $this -> saveURL($username, $token , $this -> longUrl, $this -> shortUrl);

        $message = array(
            "message" => 'URL shortened',
            "longURL" => $this -> longUrl,
            "shortURL" => $this -> shortUrl
        );

        $response -> getBody() -> write(json_encode($message));

        return $response
            -> withHeader('Content-Type', 'application/json')
            -> withStatus(200);
    }

    private function saveURL(string|null $username, string|null $token, string $long, string $short) {
        $db = new Database();

        if($username && $token) {
            $db -> query("INSERT INTO urls VALUES(NULL, :name, :long, :short)",[
                'name' => $username,
                'long' => $long,
                'short' => $short
            ]);
        }
        else {
            $db -> query("INSERT INTO urls VALUES(NULL, :name, :long, :short)",[
                'name' => null,
                'long' => $long,
                'short' => $short
            ]);
        }
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