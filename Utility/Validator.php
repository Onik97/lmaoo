<?php

class Validator 
{
    public function validateDeveloper()
    {
        if (!$_SESSION['userLoggedIn']->getLevel() >= 1)
        return null;
    }

    public function validateManager()
    {
        if (!$_SESSION['userLoggedIn']->getLevel() >= 2)
        return null;
    }

    public function validateSuperUser()
    {
        if (!$_SESSION['userLoggedIn']->getLevel() >= 3)
        return null;
    }
    
}