<?php
if (!function_exists('auth')) {
    function auth($role = null)
    {
        $instances = new RoleMiddleware;
        return $instances->handle($role);
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth('admin');
    }
}

if (!function_exists('guest')) {
    function guest()
    {
        return !auth();
    }
}
