<?php

namespace App\Http\Auth;

use App\Http\HandlerInterface;
use App\Students\StudentsTableGateway;

use function App\Functions\getFormData;

class SignUpHandler implements HandlerInterface
{
    public function __construct(private StudentsTableGateway $studentsTableGateway)
    {
    }

    public function handle()
    {
        $formData = getFormData();
        $this->studentsTableGateway->create($formData['user']);

        header('Location: /');
        return '';
    }
}
