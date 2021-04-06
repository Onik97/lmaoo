<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

class RenderController 
{
    public static function index(Router $router)
    {
        $userLoggedIn = $_SESSION["userLoggedIn"] ?? null;
        $userLoggedIn == null ? $router->render("aboutUs", "home") : $router->render("dashboard", "home");
    }

    public static function login(Router $router) { $router->render("login", "login"); }
	public static function register(Router $router) { $router->render("register", "register"); }
	public static function manager(Router $router) { $router->render("manager", "manager"); }
	public static function project(Router $router) { $router->render("project", "project"); }
	public static function admin(Router $router) { $router->render("admin", "admin"); }
}
