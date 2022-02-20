<?php

namespace App\Http;

class Session
{
    public static function start(): void
    {
        if (!self::isStarted()) {
            session_start();
        }
    }

    public static function isStarted(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}
