<?php

namespace App\Tests\Http\Handlers;

use App\Http\Auth;
use App\Students\Student;
use App\Tests\HandlerTestCase;

class EditHandlerTest extends HandlerTestCase
{
    public function testGetIndex(): void
    {
        $_SERVER['REQUEST_URI'] = '/edit';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        Auth::login(1);
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Edit', $responseContent);
    }
}
