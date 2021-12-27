<?php

namespace App\Http\Pages;

use App\Http\HandlerInterface;

use function App\Functions\view;

class EditHandler implements HandlerInterface
{
    public function handle()
    {
        http_response_code(200);
        return view('edit');
    }
}
