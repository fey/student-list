<?php

namespace App\Tests\Http\Students;

use App\Tests\HandlerTestCase;

class EditHandlerTest extends HandlerTestCase
{
    public function testGetIndex(): void
    {
        $_SERVER['REQUEST_URI'] = '/edit';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Edit', $responseContent);
    }
}
