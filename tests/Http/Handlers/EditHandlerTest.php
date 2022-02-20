<?php

namespace App\Tests\Http\Handlers;

use App\Http\Auth;
use App\Students\Student;
use App\Tests\HandlerTestCase;

class EditHandlerTest extends HandlerTestCase
{
    public function testGetEditPage(): void
    {
        $_SERVER['REQUEST_URI'] = '/edit';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        Auth::login(1);
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Edit', $responseContent);
    }

    public function testPostEditForm(): void
    {
        $_SERVER['REQUEST_URI'] = '/edit';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Auth::login(1);

        $_POST = [
            'user' => [
                'first_name' => 'Ivan',
                'last_name' => 'Ivanod',
                'email' => 'test123@email.com',
                'password' => 'password123',
                'group_id' => 'qwe123',
                'birthday' => '01-01-1970',
                'gender' => 'male',
                'exam_points' => '150',
            ]
        ];

        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode, $responseContent);
        $this->assertStringContainsString('Edit', $responseContent);
        $this->assertStringContainsString('Success', $responseContent);
    }
}
