<?php

namespace App\Students;

use DateTime;

class User
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public string $groupId,
        public DateTime $birthday,
        public string $gender,
    ) {
    }
}
