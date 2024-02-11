<?php

namespace App\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\classes\Database;

class RedirectController
{
    private string $url;
    public function getUrl(Request $request, Response $response,array $args) {
        $this -> url = $args['url'];

        $db = new Database();
        $data = $db -> query('SELECT longURL from urls WHERE shortURL=:url',[
            'url' => $this -> url
        ]);

        if(count($data)) {
            header("location: {$data[0]['longURL']}");
            exit();
        }
        $response -> getBody() -> write("URL not fount 404");
        return $response;
    }
}