<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\classes\Validator;
use App\classes\Auth;

class RegisterController
{

    private string $username;
    private string $email;
    private string $password1;
    private string $password2;

    public function register(Request $request, Response $response) {
        $errors = array();

        $parsedBody = $request -> getParsedBody();

        $this -> username = $parsedBody['username'];
        $this -> email = $parsedBody['email'];
        $this -> password1 = $parsedBody['password1'];
        $this -> password2 = $parsedBody['password2'];

        $this -> validate($errors);
        $this -> authenticate($errors);

        $response -> getBody() -> write(json_encode(['errors' => $errors]));

        return $response
            -> withHeader('Content-Type', 'application/json')
            -> withStatus(200);
    }

    private function authenticate(
        array &$errors
    ) {
        if(!Auth::passwordConfirm($this -> password1, $this -> password2)) {
            array_push($errors, 'Passwords are not the same');
        }

        if(!Auth::unique($this -> username, 'username')) {
            array_push($errors, 'Username must be unique');
        }

        if(!Auth::unique($this -> email, 'email')) {
            array_push($errors, 'Email must be unique');
        }
    }

    private function validate(
        array &$errors
    ) {
        if(!Validator::string($this -> username, 4, 64)) {
            array_push($errors, 'Username must be between 4 and 64 characters');
        }

        if(!Validator::email($this -> email)) {
            array_push($errors, 'Email is not valid');
        }

        if(!Validator::string($this -> password1, 8, (int)INF)) {
            array_push($errors, 'Password must have at least 8 characters');
        }
    }
}