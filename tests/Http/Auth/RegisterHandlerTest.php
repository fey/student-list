<?php

namespace App\Tests\Http\Auth;

use App\Tests\HandlerTestCase;

class RegisterHandlerTest extends HandlerTestCase
{
    public function testGetIndex(): void
    {
        $_SERVER['REQUEST_URI'] = '/register';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Registration', $responseContent);
    }
}
