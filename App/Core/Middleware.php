<?php
namespace Lmaoo\Core;

class Middleware
{
    public static function verifyUser($router, $userLevel)
    {
        $userLoggedIn = $_SESSION["userLoggedIn"] ?? null;
        
        if ($userLoggedIn == null)
        {
            $router->trigger404();
            http_response_code(404);
            return exit();
        }
         
        if ($userLoggedIn->level < $userLevel)
        {
            $router->trigger404();
            http_response_code(404);
            return exit();
        }
    }
}