<?php

namespace App\Functions;

function array_get(array $array, $key, mixed $default = null): mixed
{
    if (array_key_exists($key, $array)) {
        return $array[$key];
    }

    return $default;
}

function getRequestMethod(): string
{
    return $_SERVER['REQUEST_METHOD'];
}

function getRequestPath(): ?string
{
    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

    return $parsedUrl['path'];
}

function getQueryParams(): array
{
    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

    $result = [];

    parse_str($parsedUrl['query'], $result);

    return $result;
}

function getQueryParam($key, $default = null): mixed
{
    return array_get(getQueryParams(), $key, $default);
}

function getFormData(): array
{
    return $_POST;
}

function baseDir(): string
{
    return dirname(__DIR__);
}

function view(string $viewName, array $params = []): string
{
    $viewFullPath = baseDir() . '/views/' . $viewName . '.html.php';
    extract($params);
    ob_start();
    include $viewFullPath;
    return ob_get_clean();
}
