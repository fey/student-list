<?php

require_once dirname(__DIR__)  . "/vendor/autoload.php";

const METHOD_GET = 'GET';
const METHOD_POST = 'POST';

function getQueryParams()
{
    return array_merge($_GET);
}

function getQueryParam($key, $default = null)
{
    $params = getQueryParams();

    return array_key_exists($key, $params) ? $params[$key] : $default;
}

function getJsonRequestBody(): array
{
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);

    return $input ?? [];
}

function getFormData()
{
    return $_POST;
}

function getHttpMethod()
{
    return $_SERVER['REQUEST_METHOD'];
}


function getRequestUri(): string
{
    return $_SERVER['PATH_INFO'] ?? '/';
}

function isHandableRoute($method, $uri): bool
{
    return getHttpMethod() === $method && getRequestUri() === $uri;
}

switch (true):
    case isHandableRoute(METHOD_GET, '/'):
        echo '/';
        return;
    case isHandableRoute(METHOD_GET, '/register'):
        echo '/register';
        return;
endswitch;

var_dump(getRequestUri(), $_REQUEST, $_GET, $_POST, getJsonRequestBody(), $_SERVER);

exit;