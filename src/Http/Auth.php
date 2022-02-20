<?php

namespace App\Http;

use App\Students\Student;
use DomainException;

use function App\Functions\array_get;

class Auth
{
    public static function isSigned(): bool
    {
        if (!Session::isStarted()) {
            return false;
        }

        return array_get($_SESSION, 'user_id') !== null;
    }

    public static function id(): ?int
    {
        if (!Session::isStarted()) {
            return null;
        }

        return array_get($_SESSION, 'user_id');
    }

    public static function login(Student|int|null $student): void
    {
        if (!Session::isStarted()) {
            Session::start();
        }
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
        if (!Session::isStarted()) {
            return false;
        }
        return !self::isSigned();
    }

    public static function logout(): void
    {
        if (!Session::isStarted()) {
            return;
        }

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
