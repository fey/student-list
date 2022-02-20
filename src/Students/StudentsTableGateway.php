<?php

declare(strict_types=1);

namespace App\Students;

use DomainException;
use PDO;

use function App\Functions\array_get;

class StudentsTableGateway
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * @return Student[]
     */
    public function getAll(int $limit, int $offset): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM students LIMIT :limit_param OFFSET :offset_param');

        $limitParam  = $limit;
        $offsetParam = $offset;
        $statement->bindParam(':limit_param', $limitParam, PDO::PARAM_INT);
        $statement->bindParam(':offset_param', $offsetParam, PDO::PARAM_INT);
        $statement->execute();

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

    public function getById(int $id): Student
    {
        $query = 'SELECT * FROM students WHERE id = :id';

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $id);

        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            throw new DomainException('Not found');
        }

        return Student::fromArray($data);
    }

    public function countAll(): int
    {
        $query = 'SELECT COUNT(*) as count from students';
        $statement = $this->pdo->query($query);

        $data = $statement->fetchColumn();

        return (int)$data;
    }
}
