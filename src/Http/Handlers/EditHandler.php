<?php

namespace App\Http\Handlers;

use App\Http\Forms\EditForm;
use App\Http\Handlers\HandlerInterface;
use App\Students\StudentsTableGateway;

use function App\Functions\array_get;
use function App\Functions\getFormData;
use function App\Functions\view;

class EditHandler implements HandlerInterface
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
        return view('edit', ['errors' => []]);
    }

    private function signIn()
    {
        $data = array_get(getFormData(), 'user');

        $form = new EditForm($data);

        $form->validate();

        if (!$form->isValid()) {
            http_response_code(422);
            return view('edit', ['errors' => $form->errors()]);
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

        if (!password_verify($form->getPassword(), $student->hashedPassword)) {
            http_response_code(422);
            return view('login', [
                'errors' => $form->errors(),
                'flash' => [
                    'error' => 'User not found or password invalid'
                ],
            ]);
        }

        header('Location: /');
        return '';
    }
}
