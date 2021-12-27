<?php

namespace App\Http\Auth;

use App\Http\HandlerInterface;

use function App\Functions\getFormData;

class SignUpHandler implements HandlerInterface
{
    public function handle()
    {
        dd(getFormData());
        return;
    }
}
