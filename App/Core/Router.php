<?php
namespace App\Core;

use stdClass;

class Router
{
    public $getRoutes = [];
    public $postRoutes = [];

    public function __construct()
    {
        $this->userLoggedIn = new stdClass();

        if (isset($_SESSION["userLoggedIn"]))
        {
            $this->userLoggedIn->level = $_SESSION["userLoggedIn"];
        }
        else 
        {
            $this->userLoggedIn->level = null;
        }
    } 

    public function get($url, $level, $fn)
    {
        if ($level != 0)
        {
            if ($this->userLoggedIn->level == null || $this->userLoggedIn->level <= $level) 
            {
                return;
            }
        }
        
        $this->getRoutes[$url] = $fn; 
    }

    public function post($url, $level, $fn)
    {
        if ($level != 0)
        {
            if ($this->userLoggedIn->level == null || $this->userLoggedIn->level <= $level) 
            {
                return;
            }
        }

        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $url = strtok($_SERVER["REQUEST_URI"] ?? "/", '?');;
        $method = $_SERVER["REQUEST_METHOD"];

        ($method == "GET") ? $fn = $this->getRoutes[$url] ?? null : $fn = $this->postRoutes[$url] ?? null;

        if($fn)
        {
            call_user_func($fn, $this);
        }
        else
        {
            http_response_code(404);
            include __DIR__ . "/../View/notFound.php";
        }
    }
}
