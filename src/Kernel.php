<?php

namespace App;

use PDO;
use App\Students\StudentsTableGateway;
use App\Http\Handlers\IndexHandler;
use App\Http\Handlers\EditHandler;
use App\Http\Handlers\Errors\NotFoundHandler;
use App\Http\Handlers\Auth\LogoutHandler;
use App\Http\Handlers\Auth\RegisterHandler;
use App\Http\Handlers\Auth\LoginHandler;
use App\Http\Session;

use function App\Functions\array_get;
use function App\Functions\getRequestPath;
use function App\Functions\baseDir;

class Kernel
{
    public function __construct(private array $config)
    {
    }

    public function run(): string
    {
        $environment = $this->config['environment'];
        $dbConnection = $this->config['database'][$environment];
        $pdo = new PDO($dbConnection);

        $studentsTableGateway = new StudentsTableGateway($pdo);
        $passwordHasher = Hasher::build();

        $indexHandler = new IndexHandler($studentsTableGateway);
        $registerHandler = new RegisterHandler($studentsTableGateway, $passwordHasher);
        $loginHandler = new LoginHandler($studentsTableGateway, $passwordHasher);
        $editHandler = new EditHandler($studentsTableGateway, $passwordHasher);

        $notFoundHandler = new NotFoundHandler();
        $LogoutHandler = new LogoutHandler();

        $handlersByRoutesMap = [
            // students
            '/' => $indexHandler,
            '/edit' => $editHandler,

            // auth
            '/register' => $registerHandler,
            '/login' => $loginHandler,
            '/logout' => $LogoutHandler,
        ];

        $handler = array_get($handlersByRoutesMap, getRequestPath(), $notFoundHandler);

        Session::start();

        return $handler->handle();
    }
}
