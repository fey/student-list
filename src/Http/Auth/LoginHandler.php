<?php

namespace App\Http\Auth;

use App\Http\HandlerInterface;
use App\Students\StudentsTableGateway;

use function App\Functions\array_get;
use function App\Functions\getFormData;
use function App\Functions\view;

class LoginHandler implements HandlerInterface
{
    public function __construct(private StudentsTableGateway $studentsTableGateway)
    {
    }

    public function handle()
    {
        return match ($_SERVER['REQUEST_METHOD']) {
            'GET' => $this->renderForm(),
            'POST' => $this->signIn(),
        };
    }

    private function renderForm()
    {
        http_response_code(200);
        return view('login', ['errors' => []]);
    }

    private function signIn()
    {
        $email = array_get(getFormData(), 'email');

        $student = $this->studentsTableGateway->findByEmail($email);

        session_start();
        $_SESSION['student_id'] = $student->id;

        header('Location: /');
        return '';
    }
}
