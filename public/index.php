<?php

use App\Http\Request;
use App\Http\Router;

use function App\students\getStudents;
use function App\Template\view;

require_once dirname(__DIR__) . "/vendor/autoload.php";

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get(
    '/',
    function (Request $request) {
        $page = (int)$request->getQueryParam('page', 1);
        $limit = (int)$request->getQueryParam('limit', 10);

        return view(
            'index',
            [
                'students' => getStudents($page, $limit),
                'page' => $page,
            ]
        );
    }
);

$router->get('/register', fn() => view('register'));
$router->get('/login', fn() => view('login'));
$router->get('/edit', fn() => null);
$router->post('/login', fn() => null);

$router->post('/logout', fn() => null);
$router->post('/search', function (Request $request) {
    $searchSubstring = $request->getBody('search');
    return view('search');
});

$router->run();