<?php

declare(strict_types=1);

use App\Kernel;

use function App\Functions\getConfig;

require_once __DIR__ . '/../vendor/autoload.php';

$config = getConfig();
$kernel = new Kernel($config);

echo $kernel->run();
