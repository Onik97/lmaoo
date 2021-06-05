<?php
namespace Lmaoo\Core;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;
use Exception;

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

    public static function verifyJson($router, $body)
    {
        try {
            v::json()->assert($body);
        } catch(NestedValidationException $e) {
            http_response_code(400);
            exit(json_encode(array("Message" => "Only JSON body accepted")));
        }
    }
}