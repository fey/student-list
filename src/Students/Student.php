<?php

namespace App\Students;

use DateTime;

class Student
{
    public function __construct(
        public ?int $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $hashedPassword,
        public string $groupId,
        public DateTime $birthday,
        public string $gender,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['hashed_password'],
            $data['group_id'],
            new DateTime($data['birthday']),
            $data['gender']
        );
    }
}
