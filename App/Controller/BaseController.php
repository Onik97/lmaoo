<?php
namespace Lmaoo\Controller;

use Lmaoo\Core\Config;

abstract class BaseController extends Config
{
    public $userLoggedIn; 
    
    function __construct()
    {
        parent::__construct();
        $this->userLoggedIn = $_SESSION["userLoggedIn"] ?? null;
    }
}