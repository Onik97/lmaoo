<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class RouteController
{
    public static function Post($function, $userValidation = true, $callback)
    {
        if ($userValidation == false) return;

        if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["function"] == $function)
        {
            echo json_encode($callback);
        }
    }
}