<?php

namespace App\Http;

use App\Students\StudentsTableGateway;

use function App\Functions\view;

class StudentsListHandler implements HandlerInterface
{
    public function __construct(private StudentsTableGateway $studentsTableGateway)
    {
    }

    public function handle()
    {
        $students = $this->studentsTableGateway->getAll();

        return view('index', ['students' => $students]);
    }
}
