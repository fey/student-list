<?php

namespace App\Tests;

use App\Kernel;
use PHPUnit\Framework\TestCase;

use function App\Functions\getConfig;
use function App\Functions\migrate;
use function App\Functions\seed;

abstract class HandlerTestCase extends TestCase
{
    protected Kernel $app;

    protected function setUp(): void
    {
        $config = getConfig();

        $databaseConnection = $config['database']['testing'];

        migrate($databaseConnection);
        seed($databaseConnection);

        $this->app = new Kernel($config);
    }
}
