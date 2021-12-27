<?php

namespace App\Http\Auth;

use App\Http\HandlerInterface;

use function App\Functions\getFormData;

class SignInHandler implements HandlerInterface
{
    public function handle()
    {
        dd(getFormData());
    }
}
