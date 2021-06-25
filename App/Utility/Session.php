<?php
namespace Lmaoo\Utility;

class Session
{
    public static function Get(string $key)
    {
        return $_SESSION[$key];
    }

    public static function Set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }
}