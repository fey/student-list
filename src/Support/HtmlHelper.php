<?php

namespace App\Support;

class HtmlHelper
{
    public static function classNames(array $classes = [], array $extras = [])
    {
        $extraClassNames = array_keys(array_filter($extras));
        $classNames = array_merge($classes, $extraClassNames);

        return implode(' ', $classNames);
    }
}
