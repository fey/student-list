<?php

namespace App\Http\Handlers;

use App\Http\Handlers\HandlerInterface;
use App\Students\StudentsTableGateway;

use function App\Functions\view;

class IndexHandler implements HandlerInterface
{
    public function __construct(private StudentsTableGateway $studentsTableGateway)
    {
    }

    public function handle()
    {
        $students = $this->studentsTableGateway->getAll();

        http_response_code(200);
        return view('index', ['students' => $students]);
    }
}
