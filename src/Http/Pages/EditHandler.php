<?php

namespace App\Http\Pages;

use App\Http\HandlerInterface;

use function App\Functions\view;

class EditHandler implements HandlerInterface
{
    public function handle()
    {
        return view('edit');
    }
}
