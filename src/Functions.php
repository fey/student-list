<?php

namespace App\Functions;

use \PDO;

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

function migrate(string $database): void
{
    $baseDir = baseDir();
    $pdo = new PDO("sqlite:{$baseDir}/database/{$database}.sqlite3");

    $pdo->exec(<<<SQL
    DROP TABLE IF EXISTS students;
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        first_name VARCHAR NOT NULL,
        last_name VARCHAR NOT NULL,
        gender VARCAHR NOT NULL,
        email VARCHAR UNIQUE NOT NULL,
        hashed_password VARCHAR NOT NULL,
        group_id VARCHAR,
        birthday DATE NOT NULL,
        exam_points int NOT NULL
    );
    SQL);
}
