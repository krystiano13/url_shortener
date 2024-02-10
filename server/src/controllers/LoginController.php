<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\classes\Auth;
use App\classes\Database;

class LoginController
{
    private string $username;
    private string $password;

    public function login(Request $request, Response $response) {
        $body = $request -> getParsedBody();

        $this -> username = $body['username'];
        $this -> password = $body['password'];

        //error handling
        if(!$this->checkCredentials()) {
            $message = ['errors' => ['Wrong Credentials']];
            $response -> getBody() -> write(json_encode($message));
            return $response
                -> withHeader('Content-Type', 'application/json')
                -> withStatus(403);
        }

        //create token
        $token = bin2hex(openssl_random_pseudo_bytes(16));

        $db = new Database();
        $db -> query('INSERT INTO tokens VALUES(NULL, :name, :token)',[
            'name' => $this -> username,
            'token' => $token
        ]);

        $message = [
            'message' => 'Logged In',
            'username' => $this -> username,
            'token' => $token
        ];

        $response -> getBody() -> write(json_encode($message));
        return $response
            -> withHeader('Content-Type', 'application/json')
            -> withStatus(200);
    }

    private function checkCredentials():bool {
        if(!Auth::attempt($this -> username, $this -> password)) {
            return false;
        }

        return true;
    }
}