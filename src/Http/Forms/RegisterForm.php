<?php

namespace App\Http\Forms;

use DateTime;
use function App\Functions\array_get;

class RegisterForm
{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $groupId;
    private $examPoints;
    private $birthday;
    private $gender;

    private array $errors = [];

    private const MIN_AGE_YEARS = 16;
    private const GENDERS = ['male', 'female'];

    public function __construct(array $data)
    {
        $this->firstName = array_get($data, 'first_name');
        $this->lastName = array_get($data, 'last_name');
        $this->email = array_get($data, 'email');
        $this->password = array_get($data, 'password');
        $this->groupId = array_get($data, 'group_id');
        $this->examPoints = array_get($data, 'exam_points');
        $this->birthday = new DateTime(array_get($data, 'birthday'));
        $this->gender = array_get($data, 'gender');
    }

    public function validate(): void
    {
        $this->validateBirthday();
        $this->validateFirstName();
        $this->validateLastName();
        $this->validatePassword();
        $this->validateEmail();
        $this->validateExamPoints();
        $this->validateGender();
        $this->validateGroupId();
    }

    public function validateFirstName(): void
    {
        if (!$this->firstName) {
            $this->errors['first_name'] = 'First name should be';
        }
    }

    public function validateBirthday(): void
    {
        $now = new DateTime();

        $diff = $now->diff($this->birthday);

        if ($this->birthday > $now) {
            $this->errors['birthday'] = 'Birthday should not be future';
            return;
        }

        $ageInYears = $diff->y;

        if (self::MIN_AGE_YEARS > $ageInYears) {
            $this->errors['birthday'] = sprintf('min age is %s', self::MIN_AGE_YEARS);
            return;
        }
    }

    public function validateLastName(): void
    {
        if (!$this->lastName) {
            $this->errors['last_name'] = 'Last name should be';
        }
    }

    public function validateEmail(): void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email should be';
        }
    }

    public function validatePassword(): void
    {
        if (!$this->password) {
            $this->errors['password'] = 'Password should be';
        }
    }

    public function validateGroupId(): void
    {
        if (!$this->groupId) {
            $this->errors['group_id'] = 'Group ID should be';
        }
    }

    public function validateExamPoints(): void
    {
        $examPointsFilterOptions = [
            'options' => ['min_range' => 1, 'max_range' => 150]
        ];

        if (!filter_var($this->examPoints, FILTER_VALIDATE_INT, $examPointsFilterOptions)) {
            $this->errors['exam_points'] = 'Exam Points should be between 1 and 150';
        }
    }

    public function validateGender(): void
    {
        if (!$this->gender) {
            $this->errors['gender'] = 'Gender should not be empty';
            return;
        }

        if (!in_array($this->gender, self::GENDERS, true)) {
            $this->errors['gender'] = sprintf('Gender should one of: %s', implode(', ', self::GENDERS));
        }
    }

    public function isValid(): bool
    {
        return $this->errors === [];
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getGroupId(): string
    {
        return $this->groupId;
    }

    public function getExamPoints(): int
    {
        return $this->examPoints;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function getGender(): string
    {
        return $this->gender;
    }
}
