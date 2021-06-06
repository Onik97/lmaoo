<?php
namespace Lmaoo\Controller;

abstract class BaseController
{
    public object $userLoggedIn; 
    
    function __construct()
    {
        $this->userLoggedIn = $_SESSION["userLoggedIn"];
    }
}