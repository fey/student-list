<?php

namespace App\Tests\Http\Auth;

use App\Tests\HandlerTestCase;

class LoginHandlerTest extends HandlerTestCase
{
    public function testGetIndex(): void
    {
        $_SERVER['REQUEST_URI'] = '/login';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Sign in', $responseContent);
    }
}
