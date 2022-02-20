<?php

use function App\Functions\baseDir;

$baseDir = baseDir();
$dbUsername = getenv('DB_USERNAME');
$dbPassword = getenv('DB_PASSWORD');
$dbName = getenv('DB_NAME');
$dbPort = getenv('DB_PORT');
$dbHost = getenv('DB_HOST');
$environment = getenv('APP_ENV');

return [
    'environment' => $environment,
    'database' => [
        'production' => "pgsql:host={$dbHost};port={$dbPort};dbname=${dbName};user={$dbUsername};password={$dbPassword}",
        'testing' => "sqlite:{$baseDir}/database/testing.sqlite3",
        'development' => "sqlite:{$baseDir}/database/development.sqlite3",
    ],
];
