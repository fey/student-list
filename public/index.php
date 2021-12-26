<?php

declare(strict_types=1);

use App\Http\NotFoundHandler;
use App\Http\StudentsListHandler;
use App\Students\StudentsTableGateway;

use function App\Functions\array_get;
use function App\Functions\getRequestPath;
use function App\Functions\view;
use function App\Functions\baseDir;

require_once __DIR__ . '/../vendor/autoload.php';


$config = [
    'env' => getenv('APP_ENV') ?: 'development'
];
$baseDir = baseDir();
$pdo = new PDO("sqlite:{$baseDir}/database/{$config['env']}.sqlite3");

$studentsTableGateway = new StudentsTableGateway($pdo);
$studentsListHandler = new StudentsListHandler($studentsTableGateway);

$handlersByRoutesMap = [
    '/' => $studentsListHandler,
    '/register' => fn() => view('register'),
    '/login' => fn() => view('login'),
    '/logout' => fn() => 'logged out',
    '/edit' => fn() => view('edit')
];

$notFoundHandler = new NotFoundHandler();
$handler = array_get($handlersByRoutesMap, getRequestPath(), $notFoundHandler);

echo $handler->handle();
