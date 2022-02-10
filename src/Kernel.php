<?php

namespace App;

use App\Http\Auth\SignUpHandler;
use PDO;
use App\Http\Errors\NotFoundHandler;
use App\Http\Session\EditHandler;
use App\Http\Session\IndexHandler;
use App\Http\Session\LoginHandler;
use App\Http\Session\RegisterHandler;
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

        $signUpHandler = new SignUpHandler($studentsTableGateway);

        $handlersByRoutesMap = [
            '/' => $indexHandler,
            '/register' => $registerHandler,
            '/login' => $loginHandler,
            '/edit' => $editHandler,
            // '/logout' => fn() => new LogoutHandler(),
            '/sign_up' => $signUpHandler,
        ];

        $handler = array_get($handlersByRoutesMap, getRequestPath(), $notFoundHandler);

        return $handler->handle();
    }
}
