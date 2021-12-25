<?php

declare(strict_types=1);

use function App\Functions\array_get;
use function App\Functions\getRequestPath;
use function App\Functions\view;
use function App\Functions\baseDir;
require_once __DIR__ . '/../vendor/autoload.php';

$baseDir = baseDir();
$pdo = new PDO("sqlite:{$baseDir}/database/database.sqlite3");


$pdo->exec('CREATE TABLE student IF NOT EXISTS students ()');
$pdoStatement = $pdo->query('SELECT * from STUDENTS');

dd($pdoStatement->fetchAll());

$handlersByRoutesMap = [
    '/' => fn() => view('index'),
    '/register' => fn() => view('register'),
    '/login' => fn() => view('login'),
    '/logout' => fn() => 'logged out',
    '/edit' => fn() => view('edit')
];

$notFoundHandler = function () {
    http_response_code(404);
    return  view('errors/404');
};

$handler = array_get($handlersByRoutesMap, getRequestPath(), $notFoundHandler);

echo $handler();
