<?php

namespace App\students;

use App\Student;

function getStudents($page = 1, $limit = 10): array
{
    $offset = ($page - 1) * $limit;
    $students = array_map(function ($id) {
        return new \App\Student(
            'имя ' . $id,
            'фамилия ' . $id,
            sprintf('example%d@email.ru', $id),
            new \DateTime(),
            $id,
            'male',
            $id
        );
    }, range(1, 100));

    return array_slice($students, $offset, $limit);
}