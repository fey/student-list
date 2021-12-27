<?php

namespace App\Http\Errors;

use App\Http\HandlerInterface;

use function App\Functions\view;

class NotFoundHandler implements HandlerInterface
{
    public function handle()
    {
        http_response_code(404);
        return  view('errors/404');
    }
}
