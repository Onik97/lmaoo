<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../Core/Autoloader.php");

class RouteController
{
    public static function Post($function, $userValidation = true, $callback, array $callbackParameters)
    {
        if ($userValidation == false) 
        {
            http_response_code(403); echo "403"; return;
        }

        if($_SERVER["REQUEST_METHOD"] == "POST" && @$_POST["function"] == $function)
        {
            echo json_encode(call_user_func_array($callback, $callbackParameters));
            exit();
        }
    }
}
