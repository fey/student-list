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

    public function findByEmail(string $email): ?Student
    {
        $query = 'SELECT * FROM students WHERE email = :email';
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':email', $email);

        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return Student::fromArray($data);
    }

    public function create(array $data)
    {
        $query = 'INSERT INTO students
        (first_name, last_name, gender, email, group_id, hashed_password, birthday, exam_points)
            VALUES (:first_name, :last_name, :gender, :email, :group_id, :hashed_password, :birthday, :exam_points)
        ';

        $statement = $this->pdo->prepare($query);
        unset($data['id']); // FIXME
        $statement->execute($data);
    }
}
