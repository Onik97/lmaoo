<?php
namespace Lmaoo\Utility;

class ErrorMessage
{
    public static function BadRequest($message)
    {
        http_response_code(400);
        exit($message);
    }
}