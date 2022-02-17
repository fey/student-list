<?php

namespace App\Http\Auth;

use App\Http\Auth;
use App\Http\HandlerInterface;

class LogoutHandler implements HandlerInterface
{
    public function handle()
    {
        Auth::logout();
        header('Location: /');

        return '';
    }
}
