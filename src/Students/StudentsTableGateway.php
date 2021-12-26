<?php

namespace App\Students;

use PDO;

class StudentsTableGateway
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * @return Student[]
     */
    public function getAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM students');

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($studentRaw) => Student::fromArray($studentRaw), $data);
    }
}
