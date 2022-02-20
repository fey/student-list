<?php

namespace App\Http\Handlers;

use App\Hasher;
use App\Http\Auth;
use App\Http\Forms\EditForm;
use App\Http\Handlers\HandlerInterface;
use App\Students\Student;
use App\Students\StudentsTableGateway;

use function App\Functions\array_get;
use function App\Functions\getFormData;
use function App\Functions\view;

class EditHandler implements HandlerInterface
{
    public function __construct(
        private StudentsTableGateway $studentsTableGateway,
        private Hasher $hasher
    ) {
    }

    public function handle()
    {
        if (!Auth::check()) {
            http_response_code(401);
            return '';
        }

        return match ($_SERVER['REQUEST_METHOD']) {
            'GET' => $this->renderForm(),
            'POST' => $this->performEdit(),
        };
    }

    private function renderForm()
    {
        $student = $this->getCurrentUser();

        http_response_code(200);
        return view('edit', [
            'errors' => [],
            'form' => new EditForm($student->toArray()),
        ]);
    }

    private function performEdit()
    {
        $student = $this->getCurrentUser();

        $data = array_get(getFormData(), 'user');

        $form = new EditForm($data);

        $form->validate();

        if (!$form->isValid()) {
            http_response_code(422);
            return view('edit', [
                'errors' => $form->errors(),
                'form' => $form,

            ]);
        }


        if ($this->isEmailUsedByAnotherStudent($student, $form->getEmail())) {
            http_response_code(422);
            return view('edit', [
                'errors' => $form->errors(),
                'form' => $form,
                'flash' => [
                    'error' => 'Email address is already used by another'
                ]
            ]);
        }

        header('Location: /');
        return '';
    }

    private function getCurrentUser(): Student
    {
        return $this->studentsTableGateway->getById(Auth::id());
    }

    private function isEmailUsedByAnotherStudent(Student $currentStudent, string $email): bool
    {
        $otherStudent = $this->studentsTableGateway->findByEmail($email);

        return !$currentStudent->is($otherStudent);
    }
}
