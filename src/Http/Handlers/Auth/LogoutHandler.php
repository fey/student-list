<?php

namespace App\Http\Handlers\Auth;

use App\Http\Auth;
use App\Http\Handlers\HandlerInterface;

class LogoutHandler implements HandlerInterface
{
    public function handle()
    {
        Auth::logout();
        header('Location: /');

        return '';
    }
}
