<?php

namespace App\Tests\Http\Handlers\Auth;

use App\Http\Auth;
use App\Tests\HandlerTestCase;

class LogoutHandlerTest extends HandlerTestCase
{
    public function testLogout(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/logout';

        $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(302, $responseHttpCode);
        $this->assertNull(Auth::id());
        $this->assertTrue(Auth::isGuest());
    }
}
