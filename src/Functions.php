<?php

namespace App\Functions;

use App\Hasher;
use PDO;
use DateTime;

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
    $queryString = array_get($parsedUrl, 'query');

    $result = [];

    parse_str($queryString, $result);

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

function createPdo(string $dsn): PDO
{
    return new PDO($dsn);
}

function migrate(string $databaseConnection): void
{
    $pdo = new PDO($databaseConnection);

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

function seed(string $databaseConnection): void
{
    $pdo = new PDO($databaseConnection);
    $pdo->exec('DELETE FROM students');

    $birthday = new DateTime('1970-01-01');
    $passwordHasher = Hasher::build();

    $valuesParts = array_reduce(range(1, 30), function ($acc, $i) use ($birthday, $passwordHasher) {
        $examPoints = rand(50, 200);
        $attributes = [
            "first_name ${i}",
            "last_name ${i}",
            "male",
            "student${i}@test.io",
            "ASDF123",
            $passwordHasher->hashPassword('password'),
            $birthday->format('Y-m-d'),
            "$examPoints",
        ];

        $preparedAttributes = implode(', ', array_map(fn($attribute) => "'{$attribute}'", $attributes));

        return [...$acc, "($preparedAttributes)"];
    }, []);

    $joinedValuesParts = implode(",\n", $valuesParts);

    $resultQuery = "INSERT INTO students
        (first_name, last_name, gender, email, group_id, hashed_password, birthday, exam_points)
        VALUES {$joinedValuesParts};\n";
    $pdo->exec($resultQuery);
}

function sanitize($value): string
{
    return addslashes(filter_var(strip_tags(filter_var($value)), FILTER_SANITIZE_STRING));
}

function getConfig(): array
{
    $baseDir = baseDir();
    $config = require "{$baseDir}/src/config.php";

    return $config;
}
