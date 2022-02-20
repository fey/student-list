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

    public static function class(array $classList): string
    {
        $classes = [];

        foreach ($classList as $class => $constraint) {
            if (is_numeric($class)) {
                $classes[] = $constraint;
            } elseif ($constraint) {
                $classes[] = $class;
            }
        }

        $stringifyClasses = implode(' ', $classes);

        return "class=\"{$stringifyClasses}\"";
    }

    public static function href($url = null, array $query = []): string
    {
        $queryString = !empty($query) ? sprintf('?%s',http_build_query($query)) : '';

        return "href=\"{$url}{$queryString}\"";
    }
}
