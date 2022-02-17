<?php

namespace App\Tests\Http\Auth;

use App\Http\Auth;
use App\Tests\HandlerTestCase;

class LoginHandlerTest extends HandlerTestCase
{
    public function testGetLoginForm(): void
    {
        $_SERVER['REQUEST_URI'] = '/login';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Sign in', $responseContent);
    }

    public function testPerformLogin(): void
    {
        $_SERVER['REQUEST_URI'] = '/login';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST = [
            'email' => 'student1@test.io',
            'password' => 'password'
        ];

        $this->app->run();

        $this->assertEquals(302, http_response_code());

        $this->assertTrue(Auth::isSigned());
        $this->assertEquals(1, Auth::id());
    }

    public function testValidationLogin(): void
    {
        $_SERVER['REQUEST_URI'] = '/login';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST = [
            'email' => 'notExists@test.io',
            'password' => 'password'
        ];

        $this->app->run();

        $this->assertEquals(422, http_response_code());
        $this->assertTrue(Auth::isGuest());
        $this->assertNull(Auth::id());
    }
}
