<?php include_once "../../vendor/autoload.php";

use Lmaoo\Core\Middleware;

if (session_status() == PHP_SESSION_NONE) session_start();

// Documentation: https://github.com/bramus/router
$router = new Bramus\Router\Router();
$json = file_get_contents('php://input'); // Need to find a better way to handle this

// Secure all Endpoints using Middleware
$router->before('GET|POST', '/project.*', fn() => Middleware::verifyUser($router, 1));
$router->before('GET|POST', '/manager.*', fn() => Middleware::verifyUser($router, 2));
$router->before('GET|POST', '/admin.*', fn() => Middleware::verifyUser($router, 4));
$router->before('POST', '/project.*', fn() => Middleware::verifyJson($router, $json));
$router->before('POST', '/manager.*', fn() => Middleware::verifyJson($router, $json));
$router->before('POST', '/admin.*', fn() => Middleware::verifyJson($router, $json));

// Set 404 Page
$router->set404("Lmaoo\Core\Render::NotFound");

// Non-secure routes
$router->get('/', "Lmaoo\Core\Render::index" );
$router->get('/register', "Lmaoo\Core\Render::register" );
$router->get('/login', "Lmaoo\Core\Render::login" );
$router->post('/login', "Lmaoo\Controller\UserController::standardLogin" );
$router->get('/logout', "Lmaoo\Controller\UserController::logout" );

// All /project requests
$router->mount('/project', function() use ($router)
{
    $router->get('/', "Lmaoo\Core\Render::project");
});

// All /manager requests
$router->mount('/manager', function() use ($router)
{
    $json = file_get_contents('php://input'); // Need to find a better way to handle this

    $router->get('/', "Lmaoo\Core\Render::manager");
    $router->post("/", fn() => Lmaoo\Controller\ManagerController::addUsersToProject($json));
});

// All /admin requests
$router->mount('/admin', function() use ($router)
{
    $router->get('/', "Lmaoo\Core\Render::admin");
});

// For Testing Purposes
// $router->post("/test", fn() => Lmaoo\Controller\ManagerController::addUsersToProject(file_get_contents('php://input')));

$router->run();
