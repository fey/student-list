<?php

namespace App\Http\Handlers\Auth;

use App\Hasher;
use App\Http\Auth;
use App\Http\Forms\RegisterForm;
use App\Http\Handlers\HandlerInterface;
use App\Students\Student;
use App\Students\StudentsTableGateway;

use function App\Functions\array_get;
use function App\Functions\getFormData;
use function App\Functions\view;

class RegisterHandler implements HandlerInterface
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
            'POST' => $this->registerStudent(),
        };
    }

    private function renderForm()
    {
        http_response_code(200);
        return view('register', ['errors' => [], 'input' => new RegisterForm([])]);
    }

    private function registerStudent()
    {
        $formData = array_get(getFormData(), 'user', []);
        $form = new RegisterForm($formData);

        $form->validate();

        if (!$form->isValid()) {
            http_response_code(422);
            return view('register', ['errors' => $form->errors(), 'input' => $form]);
        }

        $hashedPassword = $this->hasher->hashPassword($form->getPassword());

        $student = new Student(
            null,
            $form->getFirstName(),
            $form->getLastName(),
            $form->getEmail(),
            $hashedPassword,
            $form->getGroupId(),
            $form->getBirthday(),
            $form->getGender(),
            $form->getExamPoints()
        );

        if ($this->isEmailBusy($form->getEmail())) {
            http_response_code(422);
            return view('register', [
                'errors' => $form->errors(),
                'input' => $form,
                'flash' => [
                    'error' => 'Email address is already used by another'
                ]
            ]);
        }

        $student = $this->studentsTableGateway->create($student->toArray());

        $createdStudent = $this->studentsTableGateway->findByEmail($form->getEmail());
        Auth::login($createdStudent);
        header('Location: /');
        return '';
    }

    private function isEmailBusy(string $email): bool
    {
        $otherStudent = $this->studentsTableGateway->findByEmail($email);

        return $otherStudent !== null;
    }
}
