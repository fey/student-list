<?php

namespace App\Tests\Http\Auth;

use PDO;
use App\Kernel;
use PHPUnit\Framework\TestCase;

use function App\Functions\baseDir;
use function App\Functions\createPdo;
use function App\Functions\getFormData;
use function App\Functions\migrate;
use function App\Functions\seed;

class NotFoundHandlerTest extends TestCase
{
    private Kernel $app;
    private PDO $pdo;

    protected function setUp(): void
    {
        $config = ['env' => 'testing'];

        migrate($config['env']);
        seed($config['env']);

        $this->app = new Kernel($config);
        $baseDir = baseDir();
        $database = 'testing';
        $dsn = "sqlite:{$baseDir}/database/{$database}.sqlite3";
        $this->pdo = createPdo($dsn);
    }

    public function testGetIndex(): void
    {
        $_POST = [
            'user' => [
                "first_name" => "Jopa",
                "last_name" => "Lala",
                "email" => "test@gmail.com",
                "password" => "password",
                "group_id" => "QWERTY123",
                "exam_points" => "100",
                "birthday" => "1970-01-01",
                "gender" => "male",
            ]
        ];
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/sign_up';

        $this->app->run();
        $responseHttpCode = http_response_code();
        $this->assertEquals(302, $responseHttpCode);

        $userData = getFormData()['user'];
        $condition = implode('AND ', array_map(function ($key, $value) {
            return "$key = '$value'";
        }, [
            'first_name',
            'last_name',
            'email',
            'hashed_password',
            'group_id',
            'exam_points',
            'birthday',
            'gender',
        ], $userData));

        $query = "SELECT * FROM students WHERE {$condition}";
        $statement = $this->pdo
            ->query($query);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->assertNotNull($result);
    }
}
