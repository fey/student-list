<?php

namespace App\Http\Auth;

use App\Http\Forms\RegisterForm;
use App\Http\HandlerInterface;
use App\Students\Student;
use App\Students\StudentsTableGateway;

use function App\Functions\getFormData;
use function App\Functions\view;

class RegisterHandler implements HandlerInterface
{
    public function __construct(private StudentsTableGateway $studentsTableGateway)
    {
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
        return view('register', ['errors' => []]);
    }

    private function registerStudent()
    {
        $formData = new RegisterForm(getFormData()['user']);

        $formData->validate();

        if (!$formData->isValid()) {
            return view('register', ['errors' => $formData->errors()]);
        }

        $hashedPassword = password_hash($formData->getPassword(), PASSWORD_BCRYPT);

        $student = new Student(
            null,
            $formData->getFirstName(),
            $formData->getLastName(),
            $formData->getEmail(),
            $hashedPassword,
            $formData->getGroupId(),
            $formData->getBirthday(),
            $formData->getGender(),
            $formData->getExamPoints()
        );

        $student = $this->studentsTableGateway->create($student->toArray());

        $createdStudent = $this->studentsTableGateway->findByEmail($formData->getEmail());
        header('Location: /');
        session_start();
        $_SESSION['student_id'] = $createdStudent->id;
        return '';
    }
}
