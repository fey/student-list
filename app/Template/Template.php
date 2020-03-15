<?php

namespace App\Template;
 
use function App\Http\response;

function render($template, $variables = [])
{
    extract($variables);
    ob_start();
    include $template;
    return ob_get_clean();
}

function view($view, $params = [])
{
    return response(\App\Renderer\render($view, $params));
}