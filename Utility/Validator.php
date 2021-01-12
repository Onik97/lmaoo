<?php require_once($_SERVER["DOCUMENT_ROOT"] . "lmaoo/includes/autoloader.inc.php"); 

class Validator 
{
    public static function validateDeveloper()
    {
        if (!$_SESSION['userLoggedIn']->getLevel() >= 1)
        return null;
    }

    public static function validateManager()
    {
        if (!$_SESSION['userLoggedIn']->getLevel() >= 2)
        return null;
    }

    public static function validateSuperUser()
    {
        if (!$_SESSION['userLoggedIn']->getLevel() >= 3)
        return null;
    }
    
}