<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\middleware\AuthMiddleware;
use App\classes\Database;

class UrlController
{
    private string $username;
    private string $token;

    public function getLinks(Request $request, Response $response) {
        $body = $request -> getParsedBody();

        $this -> username = $body['username'];
        $this -> token = $body['token'];

        if(!AuthMiddleware::auth($this -> token, $this -> username)) {
            $response -> getBody() -> write(json_encode(['errors' => ['Unauthorized']]));
            return $response
                -> withHeader('Content-Type', 'application/json')
                -> withStatus(403);
        }

        $data = array();
        $this -> get($response, $data);

        return $response
            -> withHeader('Content-Type', 'application/json')
            -> withStatus(200);
    }

    private function get(Response &$response, array &$data) {
        $db = new Database();
        $data = $db -> query('SELECT * FROM urls WHERE username=:username',[
            'username' => $this -> username
        ]);

        if(count($data)) {
            $response -> getBody() -> write(json_encode(['message' => 'got urls', 'data' => $data]));
        }
        else {
            $response -> getBody() -> write(json_encode(['message' => 'got urls', 'data' => array()]));
        }
    }
}