<?php
namespace Lmaoo\Utility;

class APIResponse
{
    public static function Ok($message = null)
    {
        http_response_code(200);
        exit($message);
    }

    public static function Created($message = null)
    {
        http_response_code(201);
        exit($message);
    }

    public static function NoContent($message = null)
    {
        http_response_code(204);
        exit($message);
    }

    public static function BadRequest($message)
    {
        http_response_code(400);
        exit($message);
    }

    public static function Unauthorized($message)
    {
        http_response_code(401);
        exit($message);
    }

    public static function Forbidden($message)
    {
        http_response_code(403);
        exit($message);
    }
}