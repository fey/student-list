<?php

namespace App\Http\Handlers\Auth;

use App\Hasher;
use App\Http\Auth;
use App\Http\Forms\LoginForm;
use App\Http\Handlers\HandlerInterface;
use App\Students\StudentsTableGateway;

use function App\Functions\getFormData;
use function App\Functions\view;

class LoginHandler implements HandlerInterface
{
    public function __construct(
        private StudentsTableGateway $studentsTableGateway,
        private Hasher $hasher
    ) {
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
        $data = getFormData();

        $form = new LoginForm($data);

        $form->validate();

        if (!$form->isValid()) {
            http_response_code(422);
            return view('login', ['errors' => $form->errors()]);
        }

        // TODO: add handle with password
        $student = $this->studentsTableGateway->findByEmail($form->getEmail());

        if (!$student) {
            http_response_code(422);
            return view('login', [
                'errors' => $form->errors(), 'flash' => [
                    'error' => 'User not found or password invalid'
                ],
            ]);
        }

        if (!$this->hasher->verifyPassword($form->getPassword(), $student->hashedPassword)) {
            http_response_code(422);
            return view('login', [
                'errors' => $form->errors(),
                'flash' => [
                    'error' => 'User not found or password invalid'
                ],
            ]);
        }

        Auth::login($student);
        header('Location: /');
        return '';
    }
}
