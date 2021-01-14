<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class Validator 
{
    public static function validateDeveloper()
    {
        return (!unserialize($_SESSION['userLoggedIn'])->getLevel() >= 1)
        ? false : true;
    }

    public static function validateManager()
    {
        return (!unserialize($_SESSION['userLoggedIn'])->getLevel() >= 2)
        ? false : true;
    }

    public static function validateSuperUser()
    {
        return (!unserialize($_SESSION['userLoggedIn'])->getLevel() >= 3)
        ? false : true;
    }
    
}