<?php

namespace App;

use PDO;
use App\Http\Errors\NotFoundHandler;
use App\Http\Pages\EditHandler;
use App\Http\Pages\IndexHandler;
use App\Http\Pages\LoginHandler;
use App\Http\Pages\RegisterHandler;
use App\Students\StudentsTableGateway;

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
        $registerHandler = new RegisterHandler();
        $loginHandler = new LoginHandler();
        $editHandler = new EditHandler();

        $notFoundHandler = new NotFoundHandler();

        $handlersByRoutesMap = [
            '/' => $indexHandler,
            '/register' => $registerHandler,
            '/login' => $loginHandler,
            '/edit' => $editHandler,
            // '/logout' => fn() => new LogoutHandler(),
        ];

        $handler = array_get($handlersByRoutesMap, getRequestPath(), $notFoundHandler);

        return $handler->handle();
    }
}
