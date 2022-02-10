<?php

namespace App\Tests\Http\Errors;

use App\Kernel;
use App\Tests\HandlerTestCase;
use PHPUnit\Framework\TestCase;

use function App\Functions\migrate;
use function App\Functions\seed;

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
