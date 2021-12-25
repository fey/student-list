<?php

declare(strict_types=1);

use function App\Functions\getRequestPath;
use function App\Functions\view;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = [
    '/' => fn() => view('index'),
    '/register' => fn() => view('register'),
    '/login' => fn() => view('login'),
    '/logout' => fn() => 'logged out',
    '/edit' => fn() => view('edit')
];

$requestPath = getRequestPath();

if (!array_key_exists($requestPath, $routes)) {
    http_response_code(404);
    echo '404 not Found';
    exit;
}

$handler = $routes[$requestPath];

echo $handler();
