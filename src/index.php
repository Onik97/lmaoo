<?php if(!defined('PHPUNIT_COMPOSER_INSTALL')) include_once(__DIR__ . "/../includes/autoloader.inc.php");

$router = new Router();

// Render Views

$router->get("/", [RenderController::class, "index"]);
$router->get("/login", [RenderController::class, "login"]);
$router->get("/register", [RenderController::class, "register"]);

// User Routes

$router->post("/login", [UserController::class, "standardLogin"]);


$router->resolve();