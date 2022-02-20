<?php

namespace App\Http\Forms;

use function App\Functions\array_get;
use function App\Functions\sanitize;

class LoginForm extends Form
{
    private string $password;
    private string $email;

    public function __construct(array $data)
    {
        $this->email = sanitize(array_get($data, 'email'));
        $this->password = sanitize(array_get($data, 'password'));
    }

    public function validate(): void
    {
        $this->validatePassword();
        $this->validateEmail();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    private function validateEmail(): void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email should be';
        }
    }

    private function validatePassword(): void
    {
        if (!$this->password) {
            $this->errors['password'] = 'Password should be';
        }
    }
}
