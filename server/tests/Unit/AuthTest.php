<?php

require_once __DIR__ . "/../../vendor/autoload.php";
use App\classes\Auth;

test('Detect passwords are equal', function() {
   expect(Auth::passwordConfirm('123', '123')) -> toBeTrue();
});

test('Detect passwords are different', function() {
    expect(Auth::passwordConfirm('123', '1234')) -> toBeFalse();
});

test('Detect password length is too short', function() {
    expect(Auth::passwordLength("123", 4)) -> toBeFalse();
});

test('Detect password length is proper', function() {
    expect(Auth::passwordLength("1234", 4)) -> toBeTrue();
});

test('Detect if username is unique', function() {
    expect(Auth::unique("admin", "username")) -> toBeFalse();
});

test('Detect if email is unique', function() {
    expect(Auth::unique("admin@admin.pl", "email")) -> toBeFalse();
});