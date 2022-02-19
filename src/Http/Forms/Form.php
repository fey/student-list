<?php

namespace App\Http\Forms;

abstract class Form
{
    protected array $errors = [];

    abstract public function __construct(array $data);
    abstract public function validate(): void;

    public function isValid(): bool
    {
        return $this->errors === [];
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
