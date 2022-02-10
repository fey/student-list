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
        public int $examPoints
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'hashed_password' => $this->hashedPassword,
            'group_id' => $this->groupId,
            'birthday' => $this->birthday->format('Y-m-d H:i:s'),
            'gender' => $this->gender,
            'exam_points' => $this->examPoints,
        ];
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
            $data['gender'],
            $data['exam_points']
        );
    }
}
