<?php

declare(strict_types=1);

use App\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

$config = [
    'env' => getenv('APP_ENV') ?: 'development'
];

$kernel = new Kernel($config);

echo $kernel->run();
