<?php

namespace App\Http;

use App\Students\Student;
use DomainException;

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

    public static function login(Student|int|null $student): void
    {
        $id = null;

        if (is_int($student)) {
            $id = $student;
        } else if ($student === null) {
            return;
        } else {
            $id = $student->id;
        }

        $_SESSION['user_id'] = $id;
    }

    public static function isGuest(): bool
    {
        return !self::isSigned();
    }

    public static function logout(): void
    {
        unset($_SESSION['user_id']);
    }

    public static function check()
    {
        if (self::isGuest()) {
            http_response_code(401);
            // TODO: add error exception
            // throw new DomainException('Should be signed in');

            return false;
        }

        return true;
    }
}
