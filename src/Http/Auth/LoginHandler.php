<?php

namespace App\Http\Auth;

use App\Http\HandlerInterface;

use function App\Functions\view;

class LoginHandler implements HandlerInterface
{
    public function handle()
    {
        http_response_code(200);
        return view('login');
    }
}
