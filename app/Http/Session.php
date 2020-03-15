<?php

namespace App\Http;

class Session
{
    public function start()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function destroy()
    {
        session_unset();
        session_destroy();
    }
}
