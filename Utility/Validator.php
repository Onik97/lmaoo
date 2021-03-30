<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class Validator 
{
    public static function validateUserLoggedIn()
    {
        if(!isset($_SESSION['userLoggedIn'])) @$_SESSION["userLoggedIn"] == null; // To remove notice error
        return @$_SESSION['userLoggedIn'] == null ? false : true;
    }

    public static function validateDeveloper()
    {
        if($_SESSION['userLoggedIn'] == null) return false;
        return unserialize($_SESSION['userLoggedIn'])->level >= 1 ? true : false;
    }

    public static function validateManager()
    {
        if($_SESSION['userLoggedIn'] == null) return false;
        return unserialize($_SESSION['userLoggedIn'])->level >= 2 ? true : false;
    }

    public static function validateSuperUser()
    {
        if($_SESSION['userLoggedIn'] == null) return false;
        return unserialize($_SESSION['userLoggedIn'])->level >= 3 ? true : false;
    }

    // To avoid direct access to page
    public static function ThrowNotFound()
    {
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            echo file_get_contents("../../includes/notFound.php");
            return;
        }
    }
}