<?php

namespace App\Tests\Http\Handlers;

use App\Tests\HandlerTestCase;

class IndexHandlerTest extends HandlerTestCase
{
    public function testGetIndex(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Students list', $responseContent);
        $this->assertStringContainsString('first_name 1', $responseContent);
    }
}
