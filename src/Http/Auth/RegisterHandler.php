<?php

namespace App\Http\Auth;

use App\Http\Forms\RegisterForm;
use App\Http\HandlerInterface;
use App\Students\Student;

use function App\Functions\getFormData;
use function App\Functions\view;

class RegisterHandler implements HandlerInterface
{
    public function handle()
    {
        return match ($_SERVER['REQUEST_METHOD']) {
            'GET' => $this->renderForm(),
            'POST' => $this->registerStudent(),
        };
    }

    private function renderForm()
    {
        http_response_code(200);
        return view('register', ['errors' => []]);
    }

    private function registerStudent()
    {
        $formData = new RegisterForm(getFormData()['user']);

        $formData->validate();

        if (!$formData->isValid()) {
            return view('register', ['errors' => $formData->errors()]);
        }

        dd($formData);
    }
}
