<?php

namespace App\Http;

use App\Students\Student;

use function App\Functions\array_get;

class Auth
{
    public static function isSigned(): bool
    {
        return array_get($_SESSION, 'user_id') !== null;
    }

    public static function id(): ?int
    {
        return array_get($_SESSION, 'user_id');
    }

    public static function login(Student $student): void
    {
        $_SESSION['user_id'] = $student->id;
    }

    public static function isGuest(): bool
    {
        return !self::isSigned();
    }

    public static function logout(): void
    {
        unset($_SESSION['user_id']);
    }
}
