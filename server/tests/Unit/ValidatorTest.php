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
