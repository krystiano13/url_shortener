<?php

require_once __DIR__ . "/../../vendor/autoload.php";
use App\classes\Validator;

test('Check string method (Lower than min)', function () {
    expect(Validator::string(""))->toBeFalse();
});

test('Check string method (Greater than max)', function () {
    expect(Validator::string("Hello world", 1, 5))->toBeFalse();
});

test('Check string method', function () {
    expect(Validator::string("Hello World"))->toBeTrue();
});

test('Check email method when false', function() {
    expect(Validator::email("test123")) -> toBeFalse();
});

test('Check email method when true', function() {
    expect(Validator::email("test123@o2.pl")) -> toBeTrue();
});

test('Check url method when true', function() {
    expect(Validator::url('https://www.google.pl')) -> toBeTrue();
});

test('Check url method when false', function() {
    expect(Validator::url('123')) -> toBeFalse();
});
