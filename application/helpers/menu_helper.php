<?php

if (!function_exists('active')) {
    function active_menu($controller)
    {
        $CI = get_instance();
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active' : '';
    }
}
