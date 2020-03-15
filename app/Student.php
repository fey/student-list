<?php

namespace App;

use DateTime;

class Student
{
    private const LOCAL = 'local';
    private const FOREIGN = 'foreign';
    private const RESIDENCES = [
        self::FOREIGN,
        self::LOCAL
    ];

    private const MALE = 'male';
    private const FEMALE = 'female';
    private const GENDERS = [
        self::FEMALE,
        self::MALE
    ];
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $groupNumber;
    private string $gender;
    private DateTime $birthday;
    private int $examPoints;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        DateTime $birthday,
        string $groupNumber,
        string $gender,
        int $examPoints
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->groupNumber = $groupNumber;
        $this->gender = $gender;
        $this->examPoints = $examPoints;
    }

    /**
     * @return int
     */
    public function getExamPoints(): int
    {
        return $this->examPoints;
    }

    /**
     * @param int $examPoints
     * @return Student
     */
    public function setExamPoints(int $examPoints): Student
    {
        $this->examPoints = $examPoints;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        assert(mb_strlen($firstName) > 2);
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        assert(mb_strlen($lastName) > 2);
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        assert(filter_var($email, FILTER_VALIDATE_EMAIL));
        $this->email = $email;

        return $this;
    }

    public function getGroupNumber(): string
    {
        return $this->groupNumber;
    }

    public function setGroupNumber(string $groupNumber): self
    {
        assert( 2 < mb_strlen($groupNumber) && mb_strlen($groupNumber) < 5);
        $this->groupNumber = $groupNumber;

        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        assert(in_array($gender, self::GENDERS, true));

        $this->gender = $gender;

        return $this;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }
}