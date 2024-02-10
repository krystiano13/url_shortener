<?php

namespace App\classes;

use App\classes\Database;

class Auth
{
    public static function attempt(string $username, string $password):bool {
        $db = new Database();
        $data = $db -> query('SELECT * FROM users WHERE username=:username',
            ['username' => $username]
        );

        if(!count($data)) {
            return false;
        }

        if(!password_verify($password,$data[0]['password'])) {
            return false;
        }

        return true;
    }

    public static function passwordConfirm(string $password1, string $password2):bool {
        return $password1 === $password2;
    }

    public static function passwordLength(string $password, int $min):bool {
        return strlen($password) >= $min;
    }

    public static function unique(string $value, string $column):bool {
        $db = new Database();
        $result = $db -> query("SELECT {$column} from users WHERE {$column} = :value", [
            'value' => $value
        ]);

        if(count($result) > 0) {
            return false;
        }

        if(count($result) === 0) {
            return true;
        }
    }
}