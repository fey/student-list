<?php

namespace App;

use PDO;
use App\Students\StudentsTableGateway;
use App\Http\Students\UpdateStudentHandler;
use App\Http\Students\IndexHandler;
use App\Http\Students\EditHandler;
use App\Http\Errors\NotFoundHandler;
use App\Http\Auth\LogoutHandler;
use App\Http\Auth\RegisterHandler;
use App\Http\Auth\LoginHandler;

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
        $editHandler = new EditHandler();

        $notFoundHandler = new NotFoundHandler();
        $LogoutHandler = new LogoutHandler();

        $updateStudentHandler = new UpdateStudentHandler();

        $handlersByRoutesMap = [
            // students
            '/' => $indexHandler,
            '/edit' => $editHandler,
            '/students/update' => $updateStudentHandler,
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
