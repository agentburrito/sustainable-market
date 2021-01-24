<?php

if(!function_exists('on_page')) {
    function on_page($path)
    {
        return request()->is($path);
    }
}

if(!function_exists('on_route')) {
    function on_route($route)
    {
        return \Route::current()->getName() == $route;
    }
}


if(!function_exists('return_if')) {
    function return_if($condition, $value)
    {
        if ($condition) {
            return $value;
        }
    }
}
