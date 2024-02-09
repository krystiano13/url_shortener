<?php

namespace App\classes;

class Validator
{
    public static function string(string $value, int $min = 1, int $max = 1000):bool {
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email(string $value):bool {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}