<?php

namespace App\Tests\Http\Pages;

use App\Kernel;
use PHPUnit\Framework\TestCase;

use function App\Functions\migrate;
use function App\Functions\seed;

class NotFoundHandlerTest extends TestCase
{
    private Kernel $app;

    protected function setUp(): void
    {
        $config = ['env' => 'testing'];

        migrate($config['env']);
        seed($config['env']);

        $this->app = new Kernel($config);
    }

    public function testGetIndex(): void
    {
        $_SERVER['REQUEST_URI'] = '/asd123';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(404, $responseHttpCode);
        $this->assertStringContainsString('Not found', $responseContent);
    }
}
