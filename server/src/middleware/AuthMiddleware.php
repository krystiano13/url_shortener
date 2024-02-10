<?php

namespace App\middleware;
use App\classes\Database;

class AuthMiddleware {
    public static function auth(string $token, string $username):bool {
        $db = new Database();
        $data = $db -> query(
            "SELECT * FROM tokens WHERE token=:token AND username=:username",
            [
                'username' => $username,
                'token' => $token
            ]
        );

        if(!count($data)){
            return false;
        }

        return true;
    }
}