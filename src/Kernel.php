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
        $baseDir = baseDir();
        $pdo = new PDO("sqlite:{$baseDir}/database/{$this->config['env']}.sqlite3");

        $studentsTableGateway = new StudentsTableGateway($pdo);
        $indexHandler = new IndexHandler($studentsTableGateway);
        $registerHandler = new RegisterHandler($studentsTableGateway);
        $loginHandler = new LoginHandler($studentsTableGateway);
        $editHandler = new EditHandler($studentsTableGateway);

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

        session_start();
        return $handler->handle();
    }
}
