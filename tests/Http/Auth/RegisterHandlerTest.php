<?php

namespace App\Tests\Http\Auth;

use App\Tests\HandlerTestCase;
use App\Http\Auth;

class RegisterHandlerTest extends HandlerTestCase
{
    public function testGetRegisterForm(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/register';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Registration', $responseContent);
    }

    public function testPerformRegister(): void
    {
        $_SERVER['REQUEST_URI'] = '/register';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST = [
            'user' => [
                'first_name' => 'Ivan',
                'last_name' => 'Ivanod',
                'email' => 'test@email.com',
                'password' => 'password123',
                'group_id' => 'qwe123',
                'birthday' => '01-01-1970',
                'gender' => 'male',
                'exam_points' => '100',
            ]
        ];

        $this->app->run();

        $this->assertEquals(302, http_response_code());

        $this->assertTrue(Auth::isSigned(), 'User should signed in');
        $this->assertEquals(11, Auth::id());
    }

    public function testValidationFails(): void
    {
        $_SERVER['REQUEST_URI'] = '/register';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST = [
            'first_name' => 'Ivan',
        ];

        $this->app->run();

        $this->assertEquals(422, http_response_code());
        $this->assertTrue(Auth::isGuest(), 'User should be guest');
        $this->assertNull(Auth::id());
    }
}
