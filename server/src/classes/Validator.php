<?php

namespace App\classes;

class Validator
{
    public static function string(string $value, int $min = 1, int $max = 1000):bool {
        return trim(strlen($value)) >= $min && trim(strlen($value)) <= $max;
    }

    public static function email(string $value):bool {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function url(string $value):bool {
        return filter_var($value, FILTER_VALIDATE_URL);
    }
}