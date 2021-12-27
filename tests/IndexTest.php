<?php

use App\Kernel;
use PHPUnit\Framework\TestCase;

use function App\Functions\migrate;

class StackTest extends TestCase
{
    private Kernel $app;

    protected function setUp(): void
    {
        $config = ['env' => 'testing'];

        migrate($config['env']);
        $this->app = new Kernel($config);
    }

    public function testGetIndex(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        $responseContent = $this->app->run();

        $responseHttpCode = http_response_code();

        $this->assertEquals(200, $responseHttpCode);
        $this->assertStringContainsString('Students list', $responseContent);
    }
}
