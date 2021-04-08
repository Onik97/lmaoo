<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/Autoloader.php");

class Router
{
    public $getRoutes = [];
    public $postRoutes = [];

    public function get($url, $fn) { $this->getRoutes[$url] = $fn; }

    public function post($url, $fn) { $this->postRoutes[$url] = $fn; }

    public function resolve()
    {
        $url = strtok($_SERVER["REQUEST_URI"] ?? "/", '?');;
        $method = $_SERVER["REQUEST_METHOD"];

        ($method == "GET") ? $fn = $this->getRoutes[$url] ?? null : $fn = $this->postRoutes[$url] ?? null;
        $fn ? call_user_func($fn, $this) : include __DIR__ . "/../View/notFound.php";
    }
}
