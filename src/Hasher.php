<?php

namespace App;

class Hasher
{
    private const HASH_ALGO = PASSWORD_BCRYPT;

    private string $algo;

    public static function build(): static
    {
        return new static();
    }

    public function __construct($algo = self::HASH_ALGO)
    {
        $this->algo = $algo;
    }

    public function hashPassword($password): string
    {
        return password_hash($password, $this->algo);
    }

    public function verifyPassword($password, string $hash): string
    {
        return password_verify($password, $hash);
    }
}
