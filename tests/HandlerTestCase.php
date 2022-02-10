<?php

namespace App\Tests;

use App\Kernel;
use PHPUnit\Framework\TestCase;

use function App\Functions\migrate;
use function App\Functions\seed;

abstract class HandlerTestCase extends TestCase
{
    protected Kernel $app;

    protected function setUp(): void
    {
        $config = ['env' => 'testing'];

        migrate($config['env']);
        seed($config['env']);

        $this->app = new Kernel($config);
    }
}
