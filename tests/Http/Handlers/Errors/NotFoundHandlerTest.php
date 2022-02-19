<?php

namespace App\Tests\Http\Handlers\Errors;

use App\Tests\HandlerTestCase;

class NotFoundHandlerTest extends HandlerTestCase
{
    public function testGetIndex(): void
    {
        $_SERVER['REQUEST_URI'] = '/asd123';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(404, $responseHttpCode);
        $this->assertStringContainsString('Not found', $responseContent);
    }
}
