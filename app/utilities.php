<?php

namespace Utilities;

function clean($value = '')
{
    $value = trim($value);
    // $value = stripslashes($value);
    // $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

function isPaged(int $num, int $max): bool
{
    return $num <= ceil($max / 5) && $num > 1;
}

function getRootDir()
{
    return dirname($_SERVER['DOCUMENT_ROOT']);
}